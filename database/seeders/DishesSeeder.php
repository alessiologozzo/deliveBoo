<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dish;
use App\Models\Restaurant;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

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

        for($i = 0; $i < $restaurantsNumber; $i++)
            foreach($dishes as $dish){
                $dishId++;
                $newDish = new Dish();
                $newDish->name = $dish["name"];
                $newDish->price = $dish["price"];
                $newDish->category = $dish["category"];
                $newDish->description = $dish["description"];
                $newDish->slug = Str::slug($dish["name"]) . "-" . $dishId;
                $newDish->restaurant_id = $i + 1;

                $fileType = File::mimeType(config_path() . "/images/dish-images/" . $dish["image"]);
                $upFile = new UploadedFile(config_path() . "/images/dish-images/" . $dish["image"], $dish["image"], $fileType, 0, false);
                $imagePath = $upFile->store("uploads", "public");

                $newDish->image = $imagePath;

                $newDish->save();
            }
    }
}
