<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Producto::create([
            'id'=>1,
            'nombre'=>'BASICO'
        ]);

        Producto::create([
            'id'=>2,
            'nombre'=>'CHUPAPANZA'
        ]);
        
        Producto::create([
            'id'=>3,
            'nombre'=>'BATIDO'
        ]);

        Producto::create([
            'id'=>4,
            'nombre'=>'PROTEINA'
        ]);

        Producto::create([
            'id'=>5,
            'nombre'=>'ALOE'
        ]);

        Producto::create([
            'id'=>6,
            'nombre'=>'TE'
        ]);

        Producto::create([
            'id'=>7,
            'nombre'=>'FIBRA'
        ]);

        Producto::create([
            'id'=>8,
            'nombre'=>'CR7'
        ]);

        Producto::create([
            'id'=>9,
            'nombre'=>'COLAGENO'
        ]);

        Producto::create([
            'id'=>10,
            'nombre'=>'SOPA'
        ]);

        Producto::create([
            'id'=>11,
            'nombre'=>'BARRITAS'
        ]);

        Producto::create([
            'id'=>12,
            'nombre'=>'WAFLES'
        ]);

        Producto::create([
            'id'=>13,
            'nombre'=>'PIZZA'
        ]);

        Producto::create([
            'id'=>14,
            'nombre'=>'SNACKS'
        ]);

        Producto::create([
            'id'=>15,
            'nombre'=>'EXTRAS'
        ]);

        Producto::create([
            'id'=>16,
            'nombre'=>'F. SECOS'
        ]);

        Producto::create([
            'id'=>17,
            'nombre'=>'DESAFIOS'
        ]);

        Producto::create([
            'id'=>18,
            'nombre'=>'PENSION'
        ]);
    }
}
