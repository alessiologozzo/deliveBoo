<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DishesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dishes = config("dbSeeder.dishes");
        $restaurantsNumber = Restaurant::all()->count();
        $dishId = 0;
        $newDishes = [];


        for($i = 0; $i < $restaurantsNumber; $i++) {
            $generatedDishNumber = rand(10, 16);
            $generatedDishIndexes = [];

            for($j = 0; $j < $generatedDishNumber; $j++) {
                do
                    $randomDishIndex = rand(0, count($dishes) - 1);
                while(in_array($randomDishIndex, $generatedDishIndexes));  
                array_push($generatedDishIndexes, $randomDishIndex); 

                $dishId++;

                $fileType = File::mimeType(config_path() . "/images/dish-images/" . $dishes[$randomDishIndex]["image"]);
                $upFile = new UploadedFile(config_path() . "/images/dish-images/" . $dishes[$randomDishIndex]["image"], $dishes[$randomDishIndex]["image"], $fileType, 0, false);
                $imagePath = $upFile->store("uploads", "public");

                $partialsDishes = [];
                array_push($partialsDishes, [
                    "name" => $dishes[$randomDishIndex]["name"],
                    "price" => $dishes[$randomDishIndex]["price"],
                    "image" => $imagePath,
                    "category" => $dishes[$randomDishIndex]["category"],
                    "description" => $dishes[$randomDishIndex]["description"],
                    "slug" => Str::slug($dishes[$randomDishIndex]["name"]) . "-" . $dishId,
                    "restaurant_id" => $i + 1,
                    "created_at" => now(),
                    "updated_at" => now()
                ]);

                $newDishes = array_merge($newDishes, $partialsDishes);
            }
        }

        DB::table("dishes")->insert($newDishes);
    }
}
