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

    public function updatedPostalCode(string $value): void
    {
        $value = str_replace(' ', '', $value);

        $response = Http::get('https://viacep.com.br/ws/' . $value . '/json/');

        $dadosApi = $response->json();

        if(!$dadosApi == null and empty($dadosApi['erro'])) {
            $this->error = '';

            $this->postal_code = $value;
            $this->street = $response['logradouro'];
            $this->locality = $response['bairro'];
            $this->city = $response['localidade'];
            $this->region_code = $response['uf'];
        }
        else {
            $this->street = '';
            $this->locality = '';
            $this->city = '';
            $this->region_code = '';

            if($dadosApi == null) {
                $this->error = 'O campo CEP está em um formato inválido.';
            }
            if(!empty($dadosApi['erro']) and $dadosApi['erro'] == true) {
                $this->error = 'Este CEP não foi encontrado.';
            }
        }
    }

    public function mount($address): void
    {
        if($address) {
            $this->postal_code = $address->postal_code;
            $this->street = $address->street;
            $this->number = $address->number;
            if($address->complement) {
                $this->complement = $address->complement;
            }
            $this->locality = $address->locality;
            $this->city = $address->city;
            $this->region_code = $address->region_code;
        }
    }

    public function render()
    {
        return view('livewire.inputs-address');
    }
}
