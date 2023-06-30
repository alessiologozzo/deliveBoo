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
        $restaurant = Restaurant::find(Auth::user()->id);
        $dishes = Dish::with('orders')->get();
        dd($dishes[0]->orders);
        return view('admin.orders.index', compact('generatedOrdersNumber'));
    }
}
