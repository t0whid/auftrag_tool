<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderAttachment extends Model
{
    protected $fillable = [
        'order_id',
        'file_name',
        'file_path',
        'file_type',
        'file_size',
    ];

    protected function casts(): array
    {
        return [
            'file_size' => 'integer',
        ];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function getFileUrlAttribute(): string
    {
        return asset($this->file_path);
    }

    public function getIsImageAttribute(): bool
    {
        return str_starts_with((string) $this->file_type, 'image/');
    }

    public function getIsPdfAttribute(): bool
    {
        return $this->file_type === 'application/pdf';
    }
}