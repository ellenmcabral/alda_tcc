<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class InputsAddress extends Component
{
    public string $street = '';
    public string $number = '';
    public string $complement = '';
    public string $locality = '';
    public string $city = '';
    public string $region_code = '';
    public string $postal_code = '';

    public string $error = '';

    public $address;

    public function updatedPostalCode(string $value)
    {
        $value = str_replace(' ', '', $value);

        $response = Http::get('https://viacep.com.br/ws/' . $value . '/json/');

        $dadosApi = $response->json();

        if(!$dadosApi == null) {
            if(!empty($dadosApi['erro']) and $dadosApi['erro'] == true) {
                $this->error = 'Este CEP é inválido.';
            } else {
                $this->error = '';

                $this->postal_code = $value;
                $this->street = $response['logradouro'];
                $this->locality = $response['bairro'];
                $this->city = $response['localidade'];
                $this->region_code = $response['uf'];
            }
        } else {
            $this->error = 'Este CEP é inválido.';
        }
    }
    /**
     * In Livewire components, you use mount() instead of a class constructor __construct() like you may be used to.
     */
    public function mount($address)
    {
        if($address) {
            $this->street = $address->street;
            $this->number = $address->number;
            if($address->complement) {
                $this->complement = $address->complement;
            }
            $this->locality = $address->locality;
            $this->city = $address->city;
            $this->region_code = $address->region_code;
            $this->postal_code = $address->postal_code;
        }
    }

    public function render()
    {
        return view('livewire.inputs-address');
    }
}
