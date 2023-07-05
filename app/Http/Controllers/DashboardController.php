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
            "SELECT SUBSTR(DATE_FORMAT(orders.date_time, '%Y-%M'), 6, 3) AS 'label', COUNT(DISTINCT orders.id) AS 'value'
            FROM orders
            JOIN dish_order ON orders.id = dish_order.order_id
            JOIN dishes ON dishes.id = dish_order.dish_id
            JOIN restaurants ON restaurants.id = dishes.restaurant_id
            WHERE restaurants.user_id = $userId
            AND orders.date_time BETWEEN DATE_SUB(DATE_SUB(DATE_FORMAT(CURDATE(), '%Y-%m-01'), interval 1 day), interval 6 month) AND DATE_SUB(DATE_FORMAT(CURDATE(), '%Y-%m-01'), interval 1 day)
            GROUP BY 1
            ORDER BY DATE_FORMAT(orders.date_time, '%Y-%m')
            ");


        $revenues = DB::select(
            "SELECT SUBSTR(DATE_FORMAT(orders.date_time, '%Y-%M'), 6, 3) AS 'label', SUM(dishes.price * dish_order.quantity) AS 'value'
            FROM orders
            JOIN dish_order ON orders.id = dish_order.order_id
            JOIN dishes ON dishes.id = dish_order.dish_id
            JOIN restaurants ON restaurants.id = dishes.restaurant_id
            WHERE restaurants.user_id = $userId
            AND orders.date_time BETWEEN DATE_SUB(DATE_SUB(DATE_FORMAT(CURDATE(), '%Y-%m-01'), interval 1 day), interval 6 month) AND DATE_SUB(DATE_FORMAT(CURDATE(), '%Y-%m-01'), interval 1 day)
            GROUP BY 1
            ORDER BY DATE_FORMAT(orders.date_time, '%Y-%m')
            "
        );

        return view('admin.dashboard', ["orders" => $orders, "revenues" => $revenues]);
    }
}
