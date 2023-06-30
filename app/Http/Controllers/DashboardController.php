<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Dish;

class DashboardController extends Controller
{
    public function index()
    {
        // $restaurant = Restaurant::with("dishes.orders")->where("user_id", 7)->get();

        // dd($restaurant[0]->dishes[0]->orders);

        // $restaurant = Restaurant::with("categories")->first();
        // dd($restaurant);

        // $dishes = Dish::with("orders")->get();
        // dd($dishes[0]->orders);
        return view('admin.dashboard');
    }
}
