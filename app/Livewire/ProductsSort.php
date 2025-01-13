<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsSort extends Component
{
    use WithPagination;

    public $shop;
    public $sortField = 'id';
    public $sortIconName = 'fa-sort';
    public $sortIconSalePrice = 'fa-sort';
    public $sortDirection = 'desc';

    public function sortBy($field)
    {
        if($this->sortDirection === 'asc') {
            if($field === 'name') {
                $this->sortIconName = 'fa-sort-down';
                $this->sortIconSalePrice = 'fa-sort';
            }
            if($field === 'sale_price') {
                $this->sortIconSalePrice = 'fa-sort-down';
                $this->sortIconName = 'fa-sort';
            }
            $this->sortDirection = 'desc';
        }
        else {
            if($field === 'name') {
                $this->sortIconName = 'fa-sort-up';
                $this->sortIconSalePrice = 'fa-sort';
            }
            if($field === 'sale_price') {
                $this->sortIconSalePrice = 'fa-sort-up';
                $this->sortIconName = 'fa-sort';
            }
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function render()
    {
        return view('livewire.products-sort', [
            'products' => $this->shop->products()->where('is_active', 1)->orderBy($this->sortField, $this->sortDirection)->paginate(10),
        ]);
    }
}
