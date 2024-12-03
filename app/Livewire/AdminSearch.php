<?php

namespace App\Livewire;

use App\Models\Shop;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AdminSearch extends Component
{
    use WithPagination;

    public $search = '';
    public $searchType = '';

    public function render()
    {
        if($this->searchType == 'users') {
            $results = User::where('name', 'like', '%' . $this->search . '%')->paginate(10);
        }
        if($this->searchType == 'shops') {
            $results = Shop::where('name', 'like', '%' . $this->search . '%')->paginate(10);
        }

        return view('livewire.admin-search', [
            'results' => $results,
        ]);
    }
}
