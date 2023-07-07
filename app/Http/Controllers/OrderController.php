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

    $restaurant = Restaurant::where("user_id", Auth::id())->first();
    if(!$restaurant)
        return redirect()->route("restaurants.index");

    
    $dishes = Dish::all();

    $selectedDish = $request->input('selectedDish');
    $searchedOrder = $request->input('searchedOrder');

    $userRestaurantIds = Restaurant::where('user_id', Auth::id())->pluck('id');

    $ordersQuery = Order::whereHas('dishes.restaurant', function ($query) use ($userRestaurantIds) {
        $query->whereIn('restaurant_id', $userRestaurantIds);
    });

    if ($selectedDish) {
        $ordersQuery->whereHas('dishes', function ($query) use ($selectedDish) {
            $query->where('dishes.id', $selectedDish);
        });
    }

    $orders = $ordersQuery->paginate(10);

    $searchedOrder = intval($searchedOrder);

    if ($searchedOrder) {
        $order = Order::where('id', $searchedOrder)
            ->whereHas('dishes.restaurant', function ($query) use ($userRestaurantIds) {
                $query->whereIn('restaurant_id', $userRestaurantIds);
            })
            ->first();

        $orders = collect($order ? [$order] : []);
    }

    $topExpensive = Order::with('dishes')
    ->select('orders.*')
    ->join('dish_order', 'dish_order.order_id', '=', 'orders.id')
    ->join('dishes', 'dishes.id', '=', 'dish_order.dish_id')
    ->orderBy('dishes.price', 'desc')
    ->limit(5)
    ->get();

    return view('admin.orders.index', compact('dishes', 'orders', 'selectedDish', 'searchedOrder', 'topExpensive'));
}

public function show(Order $order)
{
    $dishes = $order->dishes();
    return view('admin.orders.show', compact('order', 'dishes'));
}
}
