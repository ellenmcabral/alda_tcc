<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CommissionProduct extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'sale_price',
        'quantity',
        'total',
        'product_id',
        'commission_id',
    ];

    public function commission(): BelongsTo
    {
        return $this->belongsTo(Commission::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function formatPrice(): string
    {
        return 'R$ ' . number_format($this->sale_price, 2, ',', '.');
    }
}
