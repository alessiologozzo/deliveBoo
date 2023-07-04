<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
{
    $dishes = Dish::all();
    $orders = Order::all();

    $selectedDish = $request->input('selectedDish');
    $searchedOrder = $request->input('searchedOrder');

    $restaurants = Restaurant::with(['dishes' => function ($query) use ($searchedOrder) {
        if ($searchedOrder) {
            $query->whereHas('orders', function ($query) use ($searchedOrder) {
                $query->where('orders.id', $searchedOrder);
            });
        }
    }])
        ->where("user_id", Auth::id())
        ->paginate(15);

    return view('admin.orders.index', compact('restaurants', 'orders', 'dishes', 'selectedDish', 'searchedOrder'));
}
}
