<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusesSeeder extends Seeder
{
    static $statuses = [
        'Aguardando Pagamento',
        'Em Preparação',
        'Pedido Enviado',
        'Em Transporte',
        'Pedido Entregue',
        'Cancelado',
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::$statuses as $status) {
            DB::table('statuses')->insert([
                'description' => $status
            ]);
        }
    }
}
