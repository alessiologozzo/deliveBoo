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

    return view('admin.orders.index', compact('dishes', 'orders', 'selectedDish', 'searchedOrder'));
}

public function show(Order $order)
{
    $dishes = $order->dishes();
    return view('admin.orders.show', compact('order', 'dishes'));
}
}
