<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Restaurant;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        $dishIds = [];
        foreach ($data["items"] as $item)
            array_push($dishIds, $item["id"]);

        $dishQuantities = []; foreach ($data["items"] as $item)
            array_push($dishQuantities, $item["quantity"]);

        $dishData = [];
        for ($i = 0; $i < count($dishIds); $i++)
            $dishData[$dishIds[$i]] = ["quantity" => $dishQuantities[$i]];

        $newOrder = new Order();
        $newOrder->customer_name = $data["customer_name"];
        $newOrder->customer_address = $data["customer_address"];
        $newOrder->instructions = fake()->realTextBetween(20, 70);
        $newOrder->price = $data["price"];
        $newOrder->date_time = now();
        $newOrder->order_num = uniqid();
        $newOrder->save();
        $newOrder->dishes()->attach($dishData);
    }
}