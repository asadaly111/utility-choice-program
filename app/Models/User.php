<?php

namespace App\Models;

use App\Enums\UserRole;
use Illuminate\Http\Request;
use Plank\Mediable\Mediable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use App\Notifications\UserPasswordReset;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, Mediable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'status',
        'avatar',
        'last_login',
        'role',
    ];

    protected $guard_name = 'sanctum';

    protected $appends = ['role_name','avatar_url'];

     /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'role' => UserRole::class,
        'status' => 'boolean',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function scopeSearch($query, $queryString)
    {
        return $query
            ->where('name', 'like', '%'.$queryString.'%');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    // if user is deactive
    public function isDeactive()
    {
        return $this->status == 0;
    }

    public function isRoleEmployee()
    {
        if($this->role->value  == 'employee'){
            return true;
        }
    }

    // created at
    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }

    // created at
    public function getRoleNameAttribute()
    {
        if($this->role){
            return $this->role->name;
        }
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    // get user avatar from media library
    public function getAvatarUrlAttribute($value)
    {
        return '/storage/'.$this->avatar;
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserPasswordReset($token));
    }

    public function scopeApplyFilters($query, Request $request)
    {
        $user = auth()->user();
        $query
        ->when($request->sortDesc, function ($query, $sortDesc) {
            $query->orderByDesc('id');
        })
        ->when($request->userId, function ($query, $userId) {
            $query->where('user_id', $userId);
        })
        ->when($request->role, function ($query, $role) {
            $query->whereRole($role);
        })
        ->when(in_array($request->status,[0,1]), function ($query) use($request) {
            if(!is_null($request->status)){
                $query->where('status', $request->status);
            }
        })
        ->when($request->sortBy, function ($query, $sortBy) {
            $query->orderBy($sortBy);
        }, function ($query) {
            $query->latest();
        });
    }

    /**
     * Get the user that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(User::class);
    }

    public function employee()
    {
        return $this->belongsTo(User::class);
    }


    protected static function booted()
    {
        static::deleting(function ($item) {
            // $item->students()->delete();
            // $item->applications()->delete();
        });
    }
}
