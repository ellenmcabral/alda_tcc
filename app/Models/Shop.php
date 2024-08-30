<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shop extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'url',
        'name',
        'description',
        'cpf',
        'cnpj',
        'image',
        'is_active',
        'street',
        'number',
        'complement',
        'locality',
        'city',
        'region_code',
        'postal_code',
        'user_id',
    ];

    /**
     * Get the user that owns the shop.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the products associated with the shop.
     */
    public function products(): hasMany
    {
        return $this->hasMany(Product::class);
    }

    public function commissions(): HasMany
    {
        return $this->hasMany(Commission::class);
    }
}
