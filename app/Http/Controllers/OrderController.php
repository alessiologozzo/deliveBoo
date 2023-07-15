<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Traits\PaginationTrait;

// use App\Utils\Paginate;

class OrderController extends Controller
{
    use PaginationTrait;
    
    public function index(Request $request)
    {
        $restaurant = Restaurant::where("user_id", Auth::id())->first();

        if(!$restaurant)
            return redirect()->route("restaurants.index");

        $userId = Auth::id();
        
        $lastMonthDay = DB::select(
            "SELECT DATE_FORMAT(DATE_SUB(CURDATE(), interval 1 month), '%M %D') AS 'lastMonthDay'"
        )[0]->lastMonthDay;

        $ordersTotal = DB::select(
            "SELECT COUNT(DISTINCT orders.id) AS 'ordersTotal'
            FROM orders
            JOIN dish_order ON orders.id = dish_order.order_id
            JOIN dishes ON dishes.id = dish_order.dish_id
            JOIN restaurants ON restaurants.id = dishes.restaurant_id
            WHERE restaurants.user_id = $userId
            ")[0]->ordersTotal;

        $revenuesTotal = DB::select(
            "SELECT SUM(a.price) AS 'total' FROM 
                (SELECT orders.id, orders.price
                FROM orders
                JOIN dish_order ON orders.id = dish_order.order_id
                JOIN dishes ON dishes.id = dish_order.dish_id
                JOIN restaurants ON restaurants.id = dishes.restaurant_id
                WHERE restaurants.user_id = $userId 
                GROUP BY `orders`.`id`) 
            AS a"
        )[0]->total;

        $revenuesTotal = round(($revenuesTotal / 1000), 2);

        $ordersAvg = round(DB::select(
            "SELECT AVG(price) AS avgPrice FROM 
                (SELECT DATE_FORMAT(orders.date_time, '%Y-%m') AS annoMese, orders.id, orders.price, DATE_SUB(DATE_FORMAT(CURDATE(), '%Y-%m-01'), interval 1 day) 
                FROM orders
                JOIN dish_order ON orders.id = dish_order.order_id
                JOIN dishes ON dishes.id = dish_order.dish_id
                JOIN restaurants ON restaurants.id = dishes.restaurant_id
                WHERE restaurants.user_id = $userId 
                GROUP BY orders.id) AS a;"
        )[0]->avgPrice, 2);

        $revenuesCurrentMonthAvg = round(DB::select(
            "SELECT AVG(price) AS avgPrice FROM 
                (SELECT DATE_FORMAT(orders.date_time, '%Y-%m') AS annoMese, orders.id, orders.price, DATE_SUB(DATE_FORMAT(CURDATE(), '%Y-%m-01'), interval 1 day) 
                FROM orders
                JOIN dish_order ON orders.id = dish_order.order_id
                JOIN dishes ON dishes.id = dish_order.dish_id
                JOIN restaurants ON restaurants.id = dishes.restaurant_id
                WHERE restaurants.user_id = $userId AND YEAR(orders.date_time) = YEAR(CURDATE() - interval 1 month) AND MONTH(orders.date_time) = MONTH(CURDATE())
                GROUP BY orders.id) AS a;"
        )[0]->avgPrice, 2);

        $revenuesLastMonthAvg = round(DB::select(
            "SELECT AVG(price) AS avgPrice FROM 
                (SELECT DATE_FORMAT(orders.date_time, '%Y-%m') AS annoMese, orders.id, orders.price, DATE_SUB(DATE_FORMAT(CURDATE(), '%Y-%m-01'), interval 1 day) 
                FROM orders
                JOIN dish_order ON orders.id = dish_order.order_id
                JOIN dishes ON dishes.id = dish_order.dish_id
                JOIN restaurants ON restaurants.id = dishes.restaurant_id
                WHERE restaurants.user_id = $userId AND YEAR(orders.date_time) = YEAR(CURDATE() - interval 1 month) AND MONTH(orders.date_time) = MONTH(CURDATE() - interval 1 month)
                GROUP BY orders.id) AS a;"
        )[0]->avgPrice, 2);

        $revenuesLastMonthAvgUntil = round(DB::select(
            "SELECT AVG(price) AS avgPrice FROM 
                (SELECT DATE_FORMAT(orders.date_time, '%Y-%m') AS annoMese, orders.id, orders.price, DATE_SUB(DATE_FORMAT(CURDATE(), '%Y-%m-01'), interval 1 day) 
                FROM orders
                JOIN dish_order ON orders.id = dish_order.order_id
                JOIN dishes ON dishes.id = dish_order.dish_id
                JOIN restaurants ON restaurants.id = dishes.restaurant_id
                WHERE restaurants.user_id = $userId AND YEAR(orders.date_time) = YEAR(NOW() - interval 1 month) AND MONTH(orders.date_time) = MONTH(NOW() - interval 1 month) AND DAY(orders.date_time) BETWEEN DATE_FORMAT(CURDATE(), '01') AND DATE_FORMAT(CURDATE(), '%d')
                GROUP BY orders.id) AS a;"
        )[0]->avgPrice, 2);

        $ordersCurrentMonth = DB::select(
            "SELECT orders.date_time, COUNT(DISTINCT orders.id) AS 'currentMonthOrders'
            FROM orders
            JOIN dish_order ON orders.id = dish_order.order_id
            JOIN dishes ON dishes.id = dish_order.dish_id
            JOIN restaurants ON restaurants.id = dishes.restaurant_id
            WHERE restaurants.user_id = $userId AND YEAR(orders.date_time) = YEAR(NOW()) AND MONTH(orders.date_time) = MONTH(NOW())"
        )[0]->currentMonthOrders;

        $ordersLastMonth = DB::select(
            "SELECT orders.date_time, COUNT(DISTINCT orders.id) AS 'lastMonthOrders'
            FROM orders
            JOIN dish_order ON orders.id = dish_order.order_id
            JOIN dishes ON dishes.id = dish_order.dish_id
            JOIN restaurants ON restaurants.id = dishes.restaurant_id
            WHERE restaurants.user_id = $userId AND YEAR(orders.date_time) = YEAR(NOW() - interval 1 month) AND MONTH(orders.date_time) = MONTH(NOW() - interval 1 month)"
        )[0]->lastMonthOrders;

        $ordersLastMonthUntil = DB::select(
            "SELECT orders.date_time, COUNT(DISTINCT orders.id) AS 'lastMonthOrders'
            FROM orders
            JOIN dish_order ON orders.id = dish_order.order_id
            JOIN dishes ON dishes.id = dish_order.dish_id
            JOIN restaurants ON restaurants.id = dishes.restaurant_id
            WHERE restaurants.user_id = $userId AND YEAR(orders.date_time) = YEAR(NOW() - interval 1 month) AND MONTH(orders.date_time) = MONTH(NOW() - interval 1 month) AND DAY(orders.date_time) BETWEEN DATE_FORMAT(CURDATE(), '01') AND DATE_FORMAT(CURDATE(), '%d')"
        )[0]->lastMonthOrders;

        $revenuesCurrentMonth = DB::select(
            "SELECT SUM(a.price) AS 'total' FROM 
                (SELECT orders.id, orders.price, orders.date_time
                FROM orders
                JOIN dish_order ON orders.id = dish_order.order_id
                JOIN dishes ON dishes.id = dish_order.dish_id
                JOIN restaurants ON restaurants.id = dishes.restaurant_id
                WHERE restaurants.user_id = $userId AND YEAR(orders.date_time) = YEAR(CURDATE()) AND MONTH(orders.date_time) = MONTH(CURDATE())
                GROUP BY `orders`.`id`) 
            AS a"
        )[0]->total;

        $revenuesLastMonthUntil = DB::select(
            "SELECT SUM(a.price) AS 'total' FROM 
                (SELECT orders.id, orders.price, orders.date_time
                FROM orders
                JOIN dish_order ON orders.id = dish_order.order_id
                JOIN dishes ON dishes.id = dish_order.dish_id
                JOIN restaurants ON restaurants.id = dishes.restaurant_id
                WHERE restaurants.user_id = $userId AND YEAR(orders.date_time) = YEAR(NOW() - interval 1 month) AND MONTH(orders.date_time) = MONTH(NOW() - interval 1 month) AND DAY(orders.date_time) BETWEEN DATE_FORMAT(CURDATE(), '01') AND DATE_FORMAT(CURDATE(), '%d')
                GROUP BY `orders`.`id`) 
            AS a"
        )[0]->total;

        $revenuesLastMonth = DB::select(
            "SELECT SUM(a.price) AS 'total' FROM 
                (SELECT orders.id, orders.price, orders.date_time
                FROM orders
                JOIN dish_order ON orders.id = dish_order.order_id
                JOIN dishes ON dishes.id = dish_order.dish_id
                JOIN restaurants ON restaurants.id = dishes.restaurant_id
                WHERE restaurants.user_id = $userId AND YEAR(orders.date_time) = YEAR(NOW() - interval 1 month) AND MONTH(orders.date_time) = MONTH(NOW() - interval 1 month)
                GROUP BY `orders`.`id`) 
            AS a"
        )[0]->total;

        $revenuesLastMonth = round(($revenuesLastMonth / 1000), 2);

        $ordersCurrentMonthPercentage  = round(100 - (($ordersCurrentMonth * 100) / $ordersLastMonthUntil), 2);
        if($ordersCurrentMonthPercentage > 0)
            $ordersCurrentMonthPercentage = - abs($ordersCurrentMonthPercentage);
        else
            $ordersCurrentMonthPercentage = abs($ordersCurrentMonthPercentage);

        $revenuesCurrentMonthPercentage  = round(100 - (($revenuesCurrentMonth * 100) / $revenuesLastMonthUntil), 2);
            if($revenuesCurrentMonthPercentage > 0)
                $revenuesCurrentMonthPercentage = - abs($revenuesCurrentMonthPercentage);
            else
                $revenuesCurrentMonthPercentage = abs($revenuesCurrentMonthPercentage);

        $revenuesCurrentMonthAvgPercentage  = round(100 - (($revenuesCurrentMonthAvg * 100) / $revenuesLastMonthAvgUntil), 2);
            if($revenuesCurrentMonthAvgPercentage > 0)
                $revenuesCurrentMonthAvgPercentage = - abs($revenuesCurrentMonthAvgPercentage);
            else
                $revenuesCurrentMonthAvgPercentage = abs($revenuesCurrentMonthAvgPercentage);

        $ordersChart = DB::select(
            "SELECT SUBSTR(DATE_FORMAT(orders.date_time, '%Y-%M'), 6, 3) AS 'label', COUNT(DISTINCT orders.id) AS 'value'
            FROM orders
            JOIN dish_order ON orders.id = dish_order.order_id
            JOIN dishes ON dishes.id = dish_order.dish_id
            JOIN restaurants ON restaurants.id = dishes.restaurant_id
            WHERE restaurants.user_id = $userId
            AND YEAR(orders.date_time) BETWEEN YEAR(CURDATE() - interval 6 month) AND YEAR(CURDATE())
            AND MONTH(orders.date_time) BETWEEN MONTH(DATE_FORMAT(CURDATE(), '%Y-%m-01') - interval 6 month) AND MONTH(DATE_FORMAT(CURDATE(), '%Y-%m-01') - interval 1 day)
            GROUP BY 1
            ORDER BY DATE_FORMAT(orders.date_time, '%Y-%m')
            ");


        $revenuesChart = DB::select(
            "SELECT SUBSTR(DATE_FORMAT(orders.date_time, '%Y-%M'), 6, 3) AS 'label', SUM(dishes.price * dish_order.quantity) AS 'value'
            FROM orders
            JOIN dish_order ON orders.id = dish_order.order_id
            JOIN dishes ON dishes.id = dish_order.dish_id
            JOIN restaurants ON restaurants.id = dishes.restaurant_id
            WHERE restaurants.user_id = $userId
            AND YEAR(orders.date_time) BETWEEN YEAR(CURDATE() - interval 6 month) AND YEAR(CURDATE())
            AND MONTH(orders.date_time) BETWEEN MONTH(DATE_FORMAT(CURDATE(), '%Y-%m-01') - interval 6 month) AND MONTH(DATE_FORMAT(CURDATE(), '%Y-%m-01') - interval 1 day)
            GROUP BY 1
            ORDER BY DATE_FORMAT(orders.date_time, '%Y-%m')
            "
        );

        $totalOrdersChart = DB::select(
            "SELECT SUBSTR(DATE_FORMAT(orders.date_time, '%Y-%M'), 6, 3) AS 'label', COUNT(DISTINCT orders.id) AS 'value'
            FROM orders
            JOIN dish_order ON orders.id = dish_order.order_id
            JOIN dishes ON dishes.id = dish_order.dish_id
            JOIN restaurants ON restaurants.id = dishes.restaurant_id
            WHERE restaurants.user_id = $userId
            AND orders.date_time < DATE_SUB(DATE_FORMAT(CURDATE(), '%Y-%m-01'), interval 1 day)
            GROUP BY 1
            ORDER BY DATE_FORMAT(orders.date_time, '%Y-%m')
            ");

        $totalRevenuesChart = DB::select(
            "SELECT SUBSTR(DATE_FORMAT(orders.date_time, '%Y-%M'), 6, 3) AS 'label', SUM(dishes.price * dish_order.quantity) AS 'value'
            FROM orders
            JOIN dish_order ON orders.id = dish_order.order_id
            JOIN dishes ON dishes.id = dish_order.dish_id
            JOIN restaurants ON restaurants.id = dishes.restaurant_id
            WHERE restaurants.user_id = $userId
            AND orders.date_time < DATE_SUB(DATE_FORMAT(CURDATE(), '%Y-%m-01'), interval 1 day)
            GROUP BY 1
            ORDER BY DATE_FORMAT(orders.date_time, '%Y-%m')"
        );

        $baseQuery = "SELECT DISTINCT orders.id, orders.customer_name, orders.order_num, DATE_FORMAT(orders.date_time, '%d %M %Y') AS date, orders.price
        FROM orders
        JOIN dish_order ON dish_order.order_id = orders.id
        JOIN dishes ON dish_order.dish_id = dishes.id
        JOIN restaurants ON restaurants.id = dishes.restaurant_id
        WHERE restaurants.user_id = $userId";

        $orderNumQuery = " AND orders.order_num LIKE '$request->orderNum%'";
        $orderDishQuery = " AND dish_order.dish_id = $request->dish";
        $orderCustomerQuery = " AND customer_name LIKE '$request->customerName%'";
        $orderByDateQuery = " ORDER BY orders.date_time";
        $orderByOrderNumQuery = " ORDER BY orders.order_num";
        $orderByCustomerNameQuery = " ORDER BY orders.customer_name";
        $orderByPriceQuery = " ORDER BY orders.price";
        $ascQuery = " ASC";
        $descQuery = " DESC";

        if($request->orderNum)
            $baseQuery .=  $orderNumQuery;
        
        if($request->dish && $request->dish != "all")
            $baseQuery .= $orderDishQuery;
            
        if($request->customerName)
            $baseQuery .= $orderCustomerQuery;

        if (strcmp($request->orderBy, "orderNum") == 0)
            $baseQuery .= $orderByOrderNumQuery;
        else if (strcmp($request->orderBy, "customerName") == 0)
            $baseQuery .= $orderByCustomerNameQuery;
        else if (strcmp($request->orderBy, "orderPrice") == 0) {
            $baseQuery .= $orderByPriceQuery;
        }
        else
            $baseQuery .= $orderByDateQuery;
            
        if(strcmp($request->direction, "asc") == 0)
            $baseQuery .= $ascQuery;
        else
            $baseQuery .= $descQuery;
        
        $orders = DB::select($baseQuery);
        $orders = $this->paginate($orders, $request->fullUrl());
        

        $revenuesLastMonthUntil = round(($revenuesLastMonthUntil / 1000), 2);
        $revenuesCurrentMonth = round(($revenuesCurrentMonth / 1000), 2);

        $restaurant = Restaurant::with("dishes")->where("user_id", $userId)->first();
        $oldOrderNum = $request->orderNum;
        $oldDish = $request->dish;
        $oldCustomerName = $request->customerName;
        $oldOrderBy = $request->orderBy;
        $oldDirection = $request->direction;
        return view("admin.orders.index", ["orders" => $orders, "dishes" => $restaurant->dishes, "oldOrderNum" => $oldOrderNum, "oldDish" => $oldDish, "oldCustomerName" => $oldCustomerName, "oldOrderBy" => $oldOrderBy, "oldDirection" => $oldDirection, "ordersChart" => $ordersChart, "revenuesChart" => $revenuesChart, "ordersTotal" => $ordersTotal, "revenuesTotal" => $revenuesTotal, "ordersAvg" => $ordersAvg, "ordersCurrentMonth" => $ordersCurrentMonth, "ordersLastMonthUntil" => $ordersLastMonthUntil, "revenuesCurrentMonth" => $revenuesCurrentMonth, "revenuesLastMonthUntil" => $revenuesLastMonthUntil, "ordersCurrentMonthPercentage" => $ordersCurrentMonthPercentage, "revenuesCurrentMonthPercentage" => $revenuesCurrentMonthPercentage, "revenuesCurrentMonthAvg" => $revenuesCurrentMonthAvg, "revenuesLastMonthAvg" => $revenuesLastMonthAvg, "ordersLastMonth" => $ordersLastMonth, "revenuesLastMonth" => $revenuesLastMonth, "lastMonthDay" => $lastMonthDay, "revenuesLastMonthAvgUntil" => $revenuesLastMonthAvgUntil, "revenuesCurrentMonthAvgPercentage" => $revenuesCurrentMonthAvgPercentage, "totalOrdersChart" => $totalOrdersChart, "totalRevenuesChart" => $totalRevenuesChart]);
    }

    public function show(Order $order)
    {
        $dishes = DB::select(
            "SELECT DISTINCT dishes.name, dishes.price, dishes.category, dishes.slug, dishes.image, dish_order.order_id, dish_order.quantity
            FROM dishes
            JOIN dish_order ON dish_order.dish_id = dishes.id
            JOIN orders ON orders.id = dish_order.order_id
            WHERE dish_order.order_id = $order->id;"
        );

        return view('admin.orders.show', compact('order', 'dishes'));
    }
}