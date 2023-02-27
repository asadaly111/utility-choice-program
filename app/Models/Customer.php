<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $appends = ['document_url','name'];

    protected $fillable = [
        'document',
        'first_name',
        'last_name',
        'title',
        'email',
        'phone',
        'business_name',
        'doing_business_as',
        'business_type',
        'ein',
        'industry',
        'tax_exempt',
        'address1',
        'address2',
        'state',
        'city',
        'zip',
        'billing_address_option',
        'billing_address',
        'billing_state',
        'billing_city',
        'billing_zip',
    ];

    protected $casts = [
        'phone' => 'array',
        'status' => 'boolean',
        'tax_exempt' => 'boolean',
        'billing_address_option' => 'boolean',
    ];

    public function scopeApplyFilters($query, Request $request)
    {
        $query
        ->when($request->sortDesc, function ($query, $sortDesc) {
            $query->orderByDesc('id');
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

    // public function getTaxExemptAttribute($value)
    // {
    //     if($value){
    //         return 'Yes';
    //     }
    //     return 'No';
    // }

    public function getNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function getDocumentUrlAttribute()
    {
        if($this->document){
            return asset('storage/'.$this->document);
        }
    }
}
