<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'user',
            'email'=>'user@example.com',
            'password'=>Hash::make('123123123'),
        ]);

        User::create([
            'name'=>'Venecia',            
            'email'=>'veneciacoronadozeballos1802@gmail.com',
            'password'=>Hash::make('Venecia_2002_'),
        ]);

        // User::create([
        //     'name'=>'Ross',
        //     'email'=>'',
        //     'password'=>Hash::make(''),
        // ]);
        
    }
}


