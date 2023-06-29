<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;
use App\Models\Image;
use App\Models\Restaurant;
use Faker\Generator as Faker;

class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $restaurantNumbers = Restaurant::all()->count();

        for ($i = 0; $i < $restaurantNumbers; $i++) {

            $generatedNumbers = [];
            $imageNumbers = rand(10, 17);
            
            for ($j = 0; $j < $imageNumbers; $j++) {

                do
                    $random = rand(1, 80);
                while (array_search($random, $generatedNumbers) != false);

                array_push($generatedNumbers, $random);

                $newImage = new Image();

                $upFile = new UploadedFile(config_path() . "/images/restaurant-images/img-" . $random . "-min.jpg", "img-" . $random . "-min.jpg", "image/jpg", 0, false);
                $imagePath = $upFile->store("uploads", "public");

                $newImage->image = $imagePath;
                $newImage->restaurant_id = $i + 1;
                $newImage->save();
            }
        }
    }
}