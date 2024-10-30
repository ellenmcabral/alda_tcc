<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Commission extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'description',
        'total',
        'payment',
        'created_at',
        'updated_at',
        'user_id',
        'shop_id',
        'shipping_address_id',
        'status_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function shippingAddress(): BelongsTo
    {
        return $this->belongsTo(ShippingAddress::class);
    }

    public function commissionProducts(): HasMany
    {
        return $this->hasMany(CommissionProduct::class);
    }

    public function formatDate(string $column = 'created_at'): string
    {
        if ($column == 'created_at') {
            $date = date('d/m/Y \à\s\ H:i', strtotime($this->created_at));
        }
        if ($column == 'updated_at') {
            $date = date('d/m/Y \à\s\ H:i', strtotime($this->updated_at));
        }
        return $date;
    }

    public function formatPrice(): string
    {
        return "R$ " . number_format($this->total, 2, ',', '.');
    }
}
