<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class ProductImagesAdd extends Component
{
    use WithFileUploads;

    public $images = [];
    public $image;
    public $error;

    public function remove($key)
    {
        array_splice($this->images, $key, 1);
    }

    public function updatedImage()
    {
//        array_push($this->images, $this->image);
    }

    public function render()
    {
        $this->error = '';

        if(count($this->images) > 5) {
            $this->error = 'O máximo permitido são 5 imagens.';

            $this->images = [];
        }

        return view('livewire.product-images');
    }
}
