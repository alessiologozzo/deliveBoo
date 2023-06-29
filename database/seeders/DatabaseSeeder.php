<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        File::deleteDirectory(public_path() . "/storage/uploads");

        $this->call([
            UsersSeeder::class,
            CategoriesSeeder::class,
            RestaurantsSeeder::class,
            CategoryRestaurantsSeeder::class,
            ImagesSeeder::class,
            DishesSeeder::class,
            OrdersSeeder::class
        ]);
    }
}
