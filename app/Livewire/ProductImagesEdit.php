<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductImagesEdit extends Component
{
    use WithFileUploads;

    public $productImages = [];

    public $product;

    public $image;

    public function turnDefault($id)
    {
        $newDefaultImage = ProductImage::find($id);

        if(!$newDefaultImage->is_default) {
            $newDefaultImage->is_default = true;

            $oldDefaultImage = $this->product->productImages()->where('is_default', true)->first();
            $oldDefaultImage->is_default = false;

            $newDefaultImage->save();
            $oldDefaultImage->save();
        }
        session()->flash('status', 'Imagem principal atualizada com sucesso');

        return redirect()->to('/artesao/produtos/' . $this->product->id . '/editar');
    }

    public function delete($id, $key)
    {
        $image = ProductImage::find($id);

        if($image->is_default) {
            session()->flash('status', 'Não é possível remover a imagem principal');
            session()->flash('type', 'danger');
        } else {
            $image->delete();

            Storage::delete($image->image);

            array_splice($this->productImages, $key, 1);

            session()->flash('status', 'Imagem removida com sucesso');
        }

        return redirect()->to('/artesao/produtos/' . $this->product->id . '/editar');
    }

    public function updatedImage()
    {
        $this->validate([
            'image' => 'image|max:5000',
        ]);

        if(count($this->productImages) >= 5) {
            session()->flash('status', 'O máximo permitido são 5 imagens');
            session()->flash('type', 'danger');
        } else {
            $image = $this->image;

            $imageName = md5($image->getClientOriginalName()
                    . strtotime("now")) . "." . $image->extension();

            $image->storeAs('img/products', $imageName, 'public');

            ProductImage::create([
                'image' => $imageName,
                'product_id' => $this->product->id,
            ]);

            session()->flash('status', 'Imagem adicionada com sucesso');
        }

        return redirect()->to('/artesao/produtos/' . $this->product->id . '/editar');
    }

    public function mount($id)
    {
        $this->product = Product::where('id', $id)->first();

        $this->productImages = $this->product->productImages()->get()->all();
    }

    public function render()
    {
        return view('livewire.product-images-edit');
    }
}
