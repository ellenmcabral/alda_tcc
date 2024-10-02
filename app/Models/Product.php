<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    /**
     * Get the shop associated with the product.
     */
    public function shop(): BelongsTo
    {
        return $this->BelongsTo(Shop::class);
    }

    /**
     * Get the category associated with the product.
     */
    public function category(): BelongsTo
    {
        return $this->BelongsTo(Category::class);
    }

    public function formatPrice(): string
    {
        return 'R$ ' . number_format($this->sale_price, 2, ',', '.');
    }

    public function formatName(): string
    {
        return str_replace(array(' ', '.'), array('-', ''), $this->name);
    }

    public function getImagePath(): string
    {
        return $this->image ? '/img/products/' . $this->image : '/img/products/no-image.jpg';
    }

}
