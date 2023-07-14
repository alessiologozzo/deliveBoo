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
        $userId = Auth::id();
        
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
        

        

        $restaurant = Restaurant::with("dishes")->where("user_id", $userId)->first();
        $oldOrderNum = $request->orderNum;
        $oldDish = $request->dish;
        $oldCustomerName = $request->customerName;
        $oldOrderBy = $request->orderBy;
        $oldDirection = $request->direction;
        return view("admin.orders.index", ["orders" => $orders, "dishes" => $restaurant->dishes, "oldOrderNum" => $oldOrderNum, "oldDish" => $oldDish, "oldCustomerName" => $oldCustomerName, "oldOrderBy" => $oldOrderBy, "oldDirection" => $oldDirection]);
    }

    public function show(Order $order)
    {
        $dishes = DB::select(
            "SELECT DISTINCT dishes.name, dishes.price, dishes.category, dishes.slug, dishes.image, dish_order.order_id, dish_order.quantity, dish_order.quantity
            FROM dishes
            JOIN dish_order ON dish_order.dish_id = dishes.id
            JOIN orders ON orders.id = dish_order.order_id
            WHERE dish_order.order_id = $order->id;"
        );

        return view('admin.orders.show', compact('order', 'dishes'));
    }
}