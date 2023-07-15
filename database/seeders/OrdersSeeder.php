<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Restaurant;
use Illuminate\Support\Facades\DB;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $restaurantsNumber = Restaurant::all()->count();
        $restaurants = Restaurant::with("dishes")->get();

        DB::disableQueryLog();
        $dispatcher = DB::connection()->getEventDispatcher();
        DB::connection()->unsetEventDispatcher();

        $pivotOrderId = 0;

        for($i = 0; $i < $restaurantsNumber; $i++){
            $generatedOrdersNumber = rand(1000, 2000);
            $dishesInTheMenuNumber = count($restaurants[$i]->dishes);

            $newOrders = [$generatedOrdersNumber];
            $newDishOrders = [];
            for($j = 0; $j < $generatedOrdersNumber; $j++){

                $generatedEntryPerOrder = rand(1, 5);
                $price = 0;
                $generatedDishPerOrder = [];
                $partialsDishOrders = [$generatedEntryPerOrder];
                $pivotOrderId++;
                for($k = 0; $k < $generatedEntryPerOrder; $k++){
                    do
                        $randomDish = rand(0, $dishesInTheMenuNumber - 1);
                    while (in_array($randomDish, $generatedDishPerOrder));
                    array_push($generatedDishPerOrder, $randomDish);

                    $quantity = rand(1, 4);
                    $partialsDishOrders[$k] = [
                        "dish_id" => $restaurants[$i]->dishes[$randomDish]->id,
                        "quantity" => $quantity,
                        "order_id" => $pivotOrderId,
                        "created_at" => now(),
                        "updated_at" => now()
                    ];
                    $price += $restaurants[$i]->dishes[$randomDish]->price * $quantity;
                }

                $newDishOrders = array_merge($newDishOrders, $partialsDishOrders);

                $newOrders[$j] = [
                    "customer_name" => $faker->name(),
                    "date_time" =>  $faker->dateTimeBetween("-10 months", "now"),
                    "customer_address" => $faker->address(),
                    "instructions" => $faker->realTextBetween(20, 70),
                    "price" => $price,
                    "order_num" => substr(md5($pivotOrderId), 0, 13),
                    "created_at" => now(),
                    "updated_at" => now()
                ];
            }

            DB::table("orders")->insert($newOrders);
            DB::table("dish_order")->insert($newDishOrders);
        }


        DB::enableQueryLog();
        DB::connection()->setEventDispatcher($dispatcher);
    }
}
