<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $appends = ['name', 'document_url'];

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
        if ($request->columnFilters) {
            $key = json_decode($request->columnFilters, true);

            $query->when($key['id'], function ($query, $id) {
                $query->where('id', 'like', '%' . $id . '%');
            })
            ->when($key['name'], function ($query, $name) {
                $query->where('first_name', 'like', '%' . $name . '%')
                    ->orWhere('last_name', 'like', '%' . $name . '%');
            })
            ->when($key['email'], function ($query, $email) {
                $query->where('email', 'like', '%' . $email . '%');
            })
            ->when($key['phone'], function ($query, $phone) {
                $query->whereJsonContains('phone', [['value' => $phone]]);
            })
            ->when($key['business_name'], function ($query, $business_name) {
                $query->where('business_name', 'like', '%' . $business_name . '%');
            })
            ->when($key['doing_business_as'], function ($query, $doing_business_as) {
                $query->where('doing_business_as', 'like', '%' . $doing_business_as . '%');
            })
            ->when($key['business_type'], function ($query, $business_type) {
                $query->where('business_type', $business_type);
            })
            ->when($key['ein'], function ($query, $ein) {
                $query->where('ein', 'like', '%' . $ein . '%');
            })
            ->when($key['industry'], function ($query, $industry) {
                $query->where('industry', $industry);
            })
            ->when($key['tax_exempt'], function ($query, $tax_exempt) {
                $query->where('tax_exempt', $tax_exempt);
            })
            ->when($key['address1'], function ($query, $address1) {
                $query->where('address1', 'like', '%' . $address1 . '%');
            })
            ->when($key['address2'], function ($query, $address2) {
                $query->where('address2', 'like', '%' . $address2 . '%');
            })
            ->when($key['state'], function ($query, $state) {
                $query->where('state', 'like', '%' . $state . '%');
            })
            ->when($key['city'], function ($query, $city) {
                $query->where('city', 'like', '%' . $city . '%');
            })
            ->when($key['billing_address'], function ($query, $billing_address) {
                $query->where('billing_address', 'like', '%' . $billing_address . '%');
            })
            ->when($key['billing_state'], function ($query, $billing_state) {
                $query->where('billing_state', 'like', '%' . $billing_state . '%');
            })
            ->when($key['billing_city'], function ($query, $billing_city) {
                $query->where('billing_city', 'like', '%' . $billing_city . '%');
            })
            ->when($key['billing_zip'], function ($query, $billing_zip) {
                $query->where('billing_zip', 'like', '%' . $billing_zip . '%');
            })
            ->when($key['agency'], function ($query, $agency) {
                $query->where('agency', 'like', '%' . $agency . '%');
            })
            ->when($key['agent'], function ($query, $agent) {
                $query->where('agent', 'like', '%' . $agent . '%');
            })
            ->when($request->sortDesc, function ($query, $sortDesc) {
                $query->orderByDesc('id');
            })
            ->when($request->sortBy, function ($query, $sortBy) {
                $query->orderBy($sortBy);
            }, function ($query) {
                $query->latest();
            });
        }
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
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getDocumentUrlAttribute()
    {
        if ($this->document) {
            return asset('storage/' . $this->document);
        }
    }
}
