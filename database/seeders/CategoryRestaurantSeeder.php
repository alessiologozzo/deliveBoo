<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CategoryRestaurant;
use App\Models\Restaurant;
use App\Models\Category;

class CategoryRestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $restaurantsNumber = Restaurant::all()->count();
        $categoriesNumber = Category::all()->count();

        for($i = 0; $i < $restaurantsNumber; $i++){
            $categoriesPerRestaurant = rand(1, 4);
            $alreadyGeneratedCategories = [];
            for($j = 0; $j < $categoriesPerRestaurant; $j++){
                do
                    $randomCategory = rand(1, $categoriesNumber);
                while (array_search($randomCategory, $alreadyGeneratedCategories) != false);

                $newCategoryRestaurant = new CategoryRestaurant();
                $newCategoryRestaurant->category_id = $randomCategory;
                $newCategoryRestaurant->restaurant_id = $i + 1;
                $newCategoryRestaurant->save();
            }
            
        }
    }
}
