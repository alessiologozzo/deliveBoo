<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Doctrine\DBAL\Schema\Index;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Dish;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $orders = DB::select(
            "SELECT date_format(orders.date_time, '%Y-%m') AS 'date', COUNT(DISTINCT orders.id) AS 'orders_number'
            FROM orders 
            JOIN dish_order ON orders.id = dish_order.order_id
            JOIN dishes ON dishes.id = dish_order.dish_id
            JOIN restaurants ON restaurants.id = dishes.restaurant_id
            WHERE restaurants.user_id = $userId 
            AND orders.date_time BETWEEN date_sub(CURDATE(), interval 6 month) AND CURDATE()
            GROUP BY 1
            ");
            
        return view('admin.dashboard', ["orders" => $orders]);
    }
}
