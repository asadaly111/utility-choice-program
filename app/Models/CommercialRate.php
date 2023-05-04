<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CommercialRate extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'uuid',
        'supplier',
        'state',
        'commodity',
        'utility',
        'product',
        'demand_size',
        'rate_class',
        'start_month',
        'current_rate',
        'description',
    ];

    /**
     * Get the columns that should receive a unique identifier.
     *
     * @return array<int, string>
     */
    public function uniqueIds(): array
    {
        return ['uuid'];
    }

    // updated_at change format

    public function getUpdatedAtAttribute($value)
    {
        return date('Y-m-d H:i a', strtotime($value));
    }

    public function scopeApplyFilters($query, Request $request)
    {
        $query
            ->when($request->sortDesc, function ($query, $sortDesc) {
                $query->orderByDesc('id');
            })
            ->when($request->commodity, function ($query, $commodity) {
                $query->where('commodity', $commodity);
            })
            ->when($request->state, function ($query, $state) {
                $query->where('state', $state);
            })
            ->when($request->utility, function ($query, $utility) {
                $query->where('utility', $utility);
            })
            ->when($request->supplier, function ($query, $supplier) {
                $query->where('supplier', $supplier);
            })
            ->when($request->start_month, function ($query, $start_month) {
                $query->where('start_month', $start_month);
            })
            ->when($request->rate_class, function ($query, $rate_class) {
                $query->where('rate_class', $rate_class);
            })
            ->when($request->demand_size, function ($query, $demand_size) {
                $query->where('demand_size', $demand_size);
            })
            ->when($request->sortBy, function ($query, $sortBy) {
                $query->orderBy($sortBy);
            }, function ($query) {
                $query->latest();
            });
    }

}
