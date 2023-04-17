<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Account extends Model
{
    use HasFactory;

    protected $appends = ['lor_url','loa_url','bill_url','misc_url','tax_exempt_url'];

    protected $fillable = [
        'user_id',
        'status',
        'sub_type',
        'commodity',
        'zone',
        'utility',
        'current_rate',
        'rate_class',
        'contract_end_date',
        'account_number',
        'annual_volume',
        'city',
        'state',
        'zip',
        'address1',
        'address2',
        'document',
        'notes',
        'billing_address',
        'billing_state',
        'billing_city',
        'billing_zip',
        'bill',
        'lor',
        'loa',
        'misc',
        'tax_exempt',
    ];

    public function scopeApplyFilters($query, Request $request)
    {
        if ($request->columnFilters) {
            $key = json_decode($request->columnFilters, true);

            $query->when(isset($key['id']), function ($query, $id) {
                $query->where('id', 'like', '%' . $id . '%');
            })
            ->when(isset($key['status']), function ($query, $status) {
                $query->where('status', 'like', '%' . $status . '%');
            })
            ->when(isset($key['sub_type']), function ($query, $sub_type) {
                $query->where('sub_type', 'like', '%' . $sub_type . '%');
            })
            ->when(isset($key['commodity']), function ($query, $commodity) {
                $query->where('commodity', 'like', '%' . $commodity . '%');
            })
            ->when(isset($key['zone']), function ($query, $zone) {
                $query->where('zone', 'like', '%' . $zone . '%');
            })
            ->when(isset($key['utility']), function ($query, $utility) {
                $query->where('utility', $utility);
            })
            ->when(isset($key['current_rate']), function ($query, $current_rate) {
                $query->where('current_rate', 'like', '%' . $current_rate . '%');
            })
            ->when(isset($key['rate_class']), function ($query, $rate_class) {
                $query->where('rate_class', $rate_class);
            })
            ->when(isset($key['contract_end_date']), function ($query, $contract_end_date) {
                $query->where('contract_end_date', $contract_end_date);
            })
            ->when(isset($key['account_number']), function ($query, $account_number) {
                $query->where('account_number', 'like', '%' . $account_number . '%');
            })
            ->when(isset($key['annual_volume']), function ($query, $annual_volume) {
                $query->where('annual_volume', 'like', '%' . $annual_volume . '%');
            })
            ->when(isset($key['city']), function ($query, $city) {
                $query->where('city', 'like', '%' . $city . '%');
            })
            ->when(isset($key['state']), function ($query, $state) {
                $query->where('state', 'like', '%' . $state . '%');
            })
            ->when(isset($key['zip']), function ($query, $zip) {
                $query->where('zip', 'like', '%' . $zip . '%');
            })
            ->when(isset($key['address1']), function ($query, $address1) {
                $query->where('address1', 'like', '%' . $address1 . '%');
            })
            ->when(isset($key['address2']), function ($query, $address2) {
                $query->where('address2', 'like', '%' . $address2 . '%');
            })
            // ->when($key['notes']), function ($query, $notes) {
            //     $query->where('notes', 'like', '%' . $notes . '%');
            // })
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

    public function getLorUrlAttribute()
    {
        if ($this->lor) {
            return asset('storage/' . $this->lor);
        }
    }

    public function getLoaUrlAttribute()
    {
        if ($this->loa) {
            return asset('storage/' . $this->loa);
        }
    }

    public function getBillUrlAttribute()
    {
        if ($this->bill) {
            return asset('storage/' . $this->bill);
        }
    }

    public function getMiscUrlAttribute()
    {
        if ($this->misc) {
            return asset('storage/' . $this->misc);
        }
    }

    public function getTaxExemptUrlAttribute()
    {
        if ($this->tax_exempt) {
            return asset('storage/' . $this->tax_exempt);
        }
    }
}
