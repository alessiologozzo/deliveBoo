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
        for($i = 0; $i < $restaurantsNumber; $i++){
            $dishesNumber = count($dishes);
            $partialsDishes = [$dishesNumber];

            for($j = 0; $j < $dishesNumber; $j++){
                $dishId++;
                $fileType = File::mimeType(config_path() . "/images/dish-images/" . $dishes[$j]["image"]);
                $upFile = new UploadedFile(config_path() . "/images/dish-images/" . $dishes[$j]["image"], $dishes[$j]["image"], $fileType, 0, false);
                $imagePath = $upFile->store("uploads", "public");

                $partialsDishes[$j] = [
                    "name" => $dishes[$j]["name"],
                    "price" => $dishes[$j]["price"],
                    "image" => $imagePath,
                    "category" => $dishes[$j]["category"],
                    "description" => $dishes[$j]["description"],
                    "slug" => Str::slug($dishes[$j]["name"]) . "-" . $dishId,
                    "restaurant_id" => $i + 1,
                    "created_at" => now(),
                    "updated_at" => now()
                ];
            }

            $newDishes = array_merge($newDishes, $partialsDishes);
        }

        DB::table("dishes")->insert($newDishes);
    }
}
