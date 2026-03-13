<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'response',
        'responded_at',
    ];

    protected $casts = [
        'responded_at' => 'datetime',
    ];

    public const RESPONSE_YES = 'yes';
    public const RESPONSE_MAYBE = 'maybe';
    public const RESPONSE_NO = 'no';

    public static function responseOptions(): array
    {
        return [
            self::RESPONSE_YES,
            self::RESPONSE_MAYBE,
            self::RESPONSE_NO,
        ];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}