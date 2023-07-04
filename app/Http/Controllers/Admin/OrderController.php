<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
{
    $selectedDish = $request->input('selectedDish');
    $searchedOrder = $request->input('searchedOrder');

    $dishes = Dish::all();
    $orders = Order::all();

    $restaurants = Restaurant::with(['dishes' => function ($query) use ($selectedDish, $searchedOrder) {
        if ($selectedDish) {
            $query->where('id', $selectedDish);
        }

        if ($searchedOrder) {
            $query->where('id', $searchedOrder);
        }
    }])
        ->where("user_id", Auth::id())
        ->paginate(15);

    return view('admin.orders.index', compact('restaurants', 'dishes', 'orders', 'selectedDish', 'searchedOrder'));
}
}
