<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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



}
