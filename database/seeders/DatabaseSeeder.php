<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\DetalleVenta;
use App\Models\Inventario;
use App\Models\Producto;
use App\Models\User;
use App\Models\Venta;
use Database\Factories\ProductoFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesSeeder::class);
        Producto::factory(100)->create();
        Inventario::factory(50)->create();
        User::factory(1)->create();
        Venta::factory(100)->create();
        DetalleVenta::factory(400)->create();
        Compra::factory(100)->create();
        DetalleCompra::factory(400)->create();
    }
}
