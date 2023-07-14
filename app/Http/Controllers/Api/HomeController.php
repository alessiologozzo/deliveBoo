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
            $restaurants = Restaurant::select('restaurants.id', 'restaurants.name','restaurants.address','restaurants.slug')
                ->selectRaw('(SELECT image FROM images WHERE images.restaurant_id = restaurants.id ORDER BY id ASC LIMIT 1) AS image')
                ->selectRaw('(SELECT GROUP_CONCAT(categories.name) FROM categories
                    INNER JOIN category_restaurant ON category_restaurant.category_id = categories.id
                    WHERE category_restaurant.restaurant_id = restaurants.id) AS categories')
                ->selectRaw('(SELECT COUNT(dish_id) FROM dish_order
                    INNER JOIN dishes ON dishes.id = dish_order.dish_id
                    WHERE dishes.restaurant_id = restaurants.id) AS total_orders')
                ->paginate(10);

                foreach ($restaurants as $restaurant) {
                    $restaurant->categories = explode(',', $restaurant->categories);
                }
                
                $restaurantsAll = Restaurant::select('restaurants.id', 'restaurants.name','restaurants.address','restaurants.slug')
                    ->selectRaw('(SELECT image FROM images WHERE images.restaurant_id = restaurants.id ORDER BY id ASC LIMIT 1) AS image')
                    ->selectRaw('(SELECT GROUP_CONCAT(categories.name) FROM categories
                        INNER JOIN category_restaurant ON category_restaurant.category_id = categories.id
                        WHERE category_restaurant.restaurant_id = restaurants.id) AS categories')
                    ->selectRaw('(SELECT COUNT(dish_id) FROM dish_order
                        INNER JOIN dishes ON dishes.id = dish_order.dish_id
                        WHERE dishes.restaurant_id = restaurants.id) AS total_orders')
                    ->get();

                foreach ($restaurantsAll as $restaurant) {
                    $restaurant->categories = explode(',', $restaurant->categories);
                }
                


            $data = [
                'categories'=> $categories,
                'restaurants'=> $restaurants,
                'restaurantsAll'=> $restaurantsAll
            ];
            return response()->json([
                'status' => true,
                'message' => 'Ok',
                'results' => $data
            ], 201);
    }
}
