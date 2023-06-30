<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index() {
        $restaurant = Restaurant::with("dishes.orders")->where("user_id", Auth::id())->first();
        // dd($restaurant[0]->dishes[0]->orders);
        return view('admin.orders.index', ['dishes' => $restaurant->dishes]);
    }
}
