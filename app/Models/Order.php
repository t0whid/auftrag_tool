<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $fillable = [
        'title',
        'description',
        'location',
        'team_info',
        'start_date',
        'end_date',
        'hourly_rate',
        'travel_cost',
        'travel_cost_unit',
        'meal_allowance',
        'custom_field_1_label',
        'custom_field_1_value',
        'custom_field_2_label',
        'custom_field_2_value',
        'is_active',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'hourly_rate' => 'decimal:2',
            'travel_cost' => 'decimal:2',
            'meal_allowance' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}