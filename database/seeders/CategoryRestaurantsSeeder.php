<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CategoryRestaurant;
use App\Models\Restaurant;
use App\Models\Category;

class CategoryRestaurantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $restaurantsNumber = Restaurant::all()->count();
        $categoriesNumber = Category::all()->count();

        for($i = 0; $i < $restaurantsNumber; $i++){
            $randomCategory = rand(1, $categoriesNumber);

            $newCategoryRestaurant = new CategoryRestaurant;
            $newCategoryRestaurant->category_id = $randomCategory;
            $newCategoryRestaurant->restaurant_id = $i + 1;
            $newCategoryRestaurant->save();
        }
    }
}
