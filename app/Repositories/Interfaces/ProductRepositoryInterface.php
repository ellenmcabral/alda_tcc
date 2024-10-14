<?php

namespace App\Repositories\Interfaces;

use App\Models\Product;
use Illuminate\Http\Request;
use Ramsey\Collection\Collection;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    public function getProductsByShopId(int $id);
    public function findProductByName(string $name);
}
