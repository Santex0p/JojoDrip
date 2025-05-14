<?php

namespace Database\Seeders;

use App\Models\Admin;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Admin::factory(10)->create();

        Admin::factory()->create([
            'user' => 'Santiago',
            'password' => bcrypt('123'),
        ]);

        Product::create([
            'photo' => 'chemise-bleu.png',
            'name' => 'Zipper',
            'category' => 'homme',
            'price' => '4.99'
        ]);

        Product::create([
            'photo' => 'chemise-jolyne.png',
            'name' => 'Jolyne',
            'category' => 'homme',
            'price' => '5.99'
        ]);

        Product::create([
            'photo' => 'chemise-noir.png',
            'name' => 'Jotaro',
            'category' => 'homme',
            'price' => '9.99'
        ]);
    }
}
