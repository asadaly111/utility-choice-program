<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Http\Request;
use Plank\Mediable\Mediable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Order extends Model
{
    use HasFactory,Mediable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'comments',
        'user_id',
        'status',
    ];
      /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => OrderStatus::class,
    ];

    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('M d Y, H:i:a');
    }


    public function scopeSearch($query, $queryString)
    {
        return $query
            ->where('name', 'like', '%'.$queryString.'%')
            ->OrWhere('email', 'like', '%'.$queryString.'%')
            ->OrWhere('mobile', 'like', '%'.$queryString.'%');
    }

    public function scopeApplyFilters($query, Request $request)
    {
        $query
        ->when($request->sortDesc, function ($query, $sortDesc) {
            $query->orderByDesc('id');
        })
        ->when($request->userId, function ($query, $userId) {
            $query->where('user_id', $userId);
        })
        ->when($request->brokerId, function ($query, $userId) {
            $query->where('broker_id', $userId);
        })
        ->when($request->role, function ($query, $role) {
            $query->whereRole($role);
        })
        ->when($request->sortBy, function ($query, $sortBy) {
            $query->orderBy($sortBy);
        }, function ($query) {
            $query->latest();
        });
    }

    /**
     * Get the user that owns the Lead
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function getOrderIdAttribute()
    {

        return '#' . str_pad($this->id, 7, "0", STR_PAD_LEFT);
    }
}
