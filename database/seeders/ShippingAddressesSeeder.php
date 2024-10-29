<?php

namespace Database\Seeders;

use App\Models\ShippingAddress;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShippingAddressesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ShippingAddress::create([
        'street' => 'Juscelino Kubitschek',
            'number' => '2000',
            'complement' => 'Bloco S, apto. 105',
            'locality' => 'São Gonçalo',
            'city' => 'Pelotas',
            'region_code' => 'RS',
            'postal_code' => '96075810',
            'is_default' => true,
            'user_id' => 1,
        ]);
    }
}
