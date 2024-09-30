<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Commission extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'total',
        'payment',
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

    public function formatDate(): string
    {
        return date('d/m/Y', strtotime($this->created_at));
    }

    public function formatPrice(): string
    {
        return "R$ " . number_format($this->total, 2, ',', '.');
    }
}
