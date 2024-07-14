<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Toy;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Scale Figure'
        ]);
        Category::create([
            'name' => 'Figma'
        ]);
        Category::create([
            'name' => 'Prize Figure'
        ]);
        Category::create([
            'name' => 'Pop up Parade'
        ]);
        Category::create([
            'name' => 'Model Kit'
        ]);
        Category::create([
            'name' => 'Nendoroid'
        ]);

        User::create([
            'firstName' => 'tes',
            'lastName' => 'tes',
            'email' => 'tes@gmail.com',
            'password' => 'tes123',
        ]);

        User::create([
            'firstName' => 'admin',
            'lastName' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => 'admin123',
            'role' => 'admin',
        ]);

        for ($i = 0;$i < 60; $i++){
            Toy::create([
                'category_id' => rand(1, 6),
                'name' => fake()->word(),
                'description' => fake()->paragraph(2),
                'price' => fake()->randomNumber(),
                'stock' => fake()->numberBetween(1, 100)
            ]);
        }
    }
}
