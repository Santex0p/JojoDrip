<?php

namespace Database\Seeders;

use App\Models\Admin;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Customer;
use App\Models\Having;
use App\Models\Order;
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
            'photo' => 't-shirt-giorno.jpg',
            'name' => 'Giorno',
            'category' => 'homme',
            'price' => '4.99',
            'description' => 'test'
        ]);

        Product::create([
            'photo' => 'chemise-jolyne.jpeg',
            'name' => 'Jolyne',
            'category' => 'homme',
            'price' => '5.99',
            'description' => 'test'
        ]);

        Product::create([
            'photo' => 'chemise-bleu.jpg',
            'name' => 'Jotaro',
            'category' => 'homme',
            'price' => '9.99',
            'description' => 'test'
        ]);

        Customer::create([
            'name' => 'Pepito',
            'email' => 'pepito@gmail.com',
            'address' => 'Avenue exemple'
        ]);

        Order::create([
            'quantity' => 1,
            'customer_id' => 1,
        ]);

        Having::create([
            'product_id' => 1,
            'order_id' => 1,
        ]);
    }
}
