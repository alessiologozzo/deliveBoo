<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $restaurants = Restaurant::leftJoin('images', function($join) {
            $join->on('restaurants.id', 'images.restaurant_id')
                 ->whereRaw('images.id = (SELECT MIN(id) FROM images WHERE images.restaurant_id = restaurants.id)');
                })->select('restaurants.*', 'images.image')->paginate(10);
        $data = [
            'categories'=> $categories,
            'restaurants'=> $restaurants,
        ];
        return response()->json([
            'status' => true,
            'message' => 'Ok',
            'results' => $data
        ], 201);
    }
}
