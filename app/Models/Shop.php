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
        'created_at',
        'street',
        'number',
        'complement',
        'locality',
        'city',
        'region_code',
        'postal_code',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): hasMany
    {
        return $this->hasMany(Product::class);
    }

    public function commissions(): HasMany
    {
        return $this->hasMany(Commission::class);
    }

    public function formatUrl(): string
    {
        return '@' . $this->url;
    }

    public function formatDate(): string
    {
        return date('d/m/Y', strtotime($this->created_at));
    }

    public function getImagePath(): string
    {
        return $this->image ? '/img/shops/' . $this->image : '/img/assets/no-image.jpg';
    }
}
