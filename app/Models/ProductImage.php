<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'image',
        'product_id',
        'is_default',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getImagePath(): string
    {
        return Storage::disk('s3')->url('img/products/' . $this->image);
    }
}
