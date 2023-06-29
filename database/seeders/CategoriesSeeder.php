<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = config("dbSeeder.categories");

        foreach($categories as $category){
            $newCategory = new Category();
            $newCategory->name = $category["name"];
            $newCategory->slug = Str::slug($category["name"]);

            $fileType = File::mimeType(config_path() . "/images/category-images/" . $category["image"]);
            $upFile = new UploadedFile(config_path() . "/images/category-images/" . $category["image"], $category["image"], $fileType, 0, false);
            $imagePath = $upFile->store("uploads", "public");

            $newCategory->image = $imagePath;
            $newCategory->save();
        }
    }
}
