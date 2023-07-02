<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;
use App\Models\Restaurant;

class UsersRestaurantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $restaurants = config("dbSeeder.restaurants");
        $restaurantsNumber = count($restaurants);

        $newUsers = [$restaurantsNumber];
        for($i = 0; $i < $restaurantsNumber; $i++){
            $email = fake()->unique()->safeEmail();
            $newUsers[$i] = [
                "first_name" => fake()->firstName(),
                "last_name" => fake()->lastName(),
                "email" => $email,
                'email_verified_at' => now(),
                'password' => Hash::make($email),
                'remember_token' => Str::random(10),
                "created_at" => now(),
                "updated_at" => now()
            ];
        }
        DB::table("users")->insert($newUsers);

        
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
