<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class ResturantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::leftJoin('images', function($join) {
            $join->on('restaurants.id', 'images.restaurant_id')
                 ->whereRaw('images.id = (SELECT MIN(id) FROM images WHERE images.restaurant_id = restaurants.id)');
                })->select('restaurants.*', 'images.image')->paginate(10);

        $categories = Category::all();
        $data = [
            'restaurants'=> $restaurants,
            'restaurantsAll'=> $restaurantsAll,
            'categories'=> $categories
        ];
        return response()->json([
            'status' => true,
            'message' => 'Ok',
            'results' => $data
        ], 201);
    }


    public function show($slug)
    {
        $restaurant = Restaurant::with('categories','dishes','images')->where('slug', $slug)->first();
        //$category = $restaurant->categories()->get();
        //dd($category);
        $data = [
            'restaurant'=> $restaurant,
            //'category'=> $category,
        ];
        return response()->json([
            'status' => true,
            'message' => 'Ok',
            'results' => $data
        ], 201);
    }
}
