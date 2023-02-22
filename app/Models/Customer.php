<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

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
    ];

    protected $casts = [
        'phone' => 'array',
        'status' => 'boolean',
        'tax_exempt' => 'boolean',
        'billing_address_option' => 'boolean',
    ];

    public function getDocumentAttribute($value)
    {
        if($value){
            return asset('storage/'.$value);
        }
    }
}
