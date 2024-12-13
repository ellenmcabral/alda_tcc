<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'image',
        'name',
        'url',
        'description',
        'sale_price',
        'shop_id',
        'category_id',
    ];

    public function shop(): BelongsTo
    {
        return $this->BelongsTo(Shop::class);
    }

    public function category(): BelongsTo
    {
        return $this->BelongsTo(Category::class);
    }

    public function productImages(): HasMany
    {
        return $this->HasMany(ProductImage::class);
    }

    public function formatPrice(): string
    {
        return 'R$ ' . number_format($this->sale_price, 2, ',', '.');
    }

    public function formatName(): string
    {
        $name = strtolower($this->name);

        return str_replace(array(' ', '.'), array('-', ''), $name);
    }

    public function getDefaultImagePath(): string
    {
        return $this->productImages()->where('is_default', true)->first()->getImagePath();
    }
}
