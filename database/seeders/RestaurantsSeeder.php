<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class RestaurantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $restaurants = config("dbSeeder.restaurants");
        $i = 0;
        foreach($restaurants as $restaurant){
            $i++;
            $newRestaurant = new Restaurant();
            $newRestaurant->name = $restaurant["name"];
            $newRestaurant->address = $restaurant["address"];
            $newRestaurant->user_id = $i;
            $newRestaurant->slug = Str::slug($restaurant["name"]) . "-" . $i;

            $fileType = File::mimeType(config_path() . "/images/logo/" . $restaurant["logo"]);
            $upFile = new UploadedFile(config_path() . "/images/logo/" . $restaurant["logo"], $restaurant["logo"], $fileType, 0, false);
            $imagePath = $upFile->store("uploads", "public");

            $newRestaurant->logo = $imagePath;
            $newRestaurant->save();
        }
    }
}
