<?php

namespace App\Models;

use App\Models\Contract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Contract extends Model
{
    use HasFactory;

    // protected $appends = ['name', 'document_url'];

    protected $fillable = [
        'user_id',
        'customer_id',
        'account_id',
        'state',
        'utility',
        'account_number',
        'ein',
        'commodity',
        'supplier',
        'product',
        'start_month',
        'rate_class',
        'current_rate',
        'volume',
        'status',
        'flag',
        // 'start_date',
        // 'end_date',
        'document',
        'document_url',
    ];

    public function scopeApplyFilters($query, Request $request)
    {
        if ($request->columnFilters) {
            $key = json_decode($request->columnFilters, true);
            $query
            // $query->when($key['id'], function ($query, $id) {
            //     $query->where('id', 'like', '%' . $id . '%');
            // })
            // ->when($key['name'], function ($query, $name) {
            //     $query->where('first_name', 'like', '%' . $name . '%')
            //         ->orWhere('last_name', 'like', '%' . $name . '%');
            // })
            ->when($key['account_number'], function ($query, $account_number) {
                $query->where('account_number', 'like', '%' . $account_number . '%');
            })
            // ->when($key['phone'], function ($query, $phone) {
            //     $query->whereJsonContains('phone', [['value' => $phone]]);
            // })
            ->when($key['ein'], function ($query, $ein) {
                $query->where('ein', 'like', '%' . $ein . '%');
            })
            ->when($key['commodity'], function ($query, $commodity) {
                $query->where('commodity', 'like', '%' . $commodity . '%');
            })
            ->when($key['supplier'], function ($query, $supplier) {
                $query->where('supplier', $supplier);
            })
            ->when($key['product'], function ($query, $product) {
                $query->where('product', 'like', '%' . $product . '%');
            })
            ->when($key['start_month'], function ($query, $start_month) {
                $query->where('start_month', $start_month);
            })
            // ->when($key['rate_class'], function ($query, $rate_class) {
            //     $query->where('rate_class', $rate_class);
            // })
            ->when($key['volume'], function ($query, $volume) {
                $query->where('volume', 'like', '%' . $volume . '%');
            })
            ->when($key['current_rate'], function ($query, $current_rate) {
                $query->where('current_rate', 'like', '%' . $current_rate . '%');
            })
            ->when($key['state'], function ($query, $state) {
                $query->where('state', 'like', '%' . $state . '%');
            })
            ->when($key['utility'], function ($query, $utility) {
                $query->where('utility', 'like', '%' . $utility . '%');
            })
            ->when($key['status'], function ($query, $status) {
                $query->where('status', 'like', '%' . $status . '%');
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

    // user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // customer

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // account

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function getDocumentUrlAttribute()
    {
        if ($this->document) {
            return asset('storage/' . $this->document);
        }
    }
}
