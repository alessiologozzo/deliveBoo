<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\DishOrder;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $restaurantsNumber = Restaurant::all()->count();
        $restaurants = Restaurant::with("dishes")->get();

        for($i = 0; $i < $restaurantsNumber; $i++){
            $generatedOrdersNumber = rand(80, 200);
            $dishesInTheMenuNumber = count($restaurants[$i]->dishes);

            for($j = 0; $j < $generatedOrdersNumber; $j++){
                $newOrder = new Order();
                $newOrder->customer_name = $faker->name();
                $newOrder->date_time = $faker->dateTimeBetween("-1 years", "now");
                $newOrder->customer_address = $faker->address();
                $newOrder->instructions = $faker->realTextBetween(20, 70);
                $newOrder->price = 0;
                $newOrder->order_num = "";
                $newOrder->save();

                $generatedEntryPerOrder = rand(1, 5);
                $price = 0;
                $generatedDishPerOrder = [];
                for($k = 0; $k < $generatedEntryPerOrder; $k++){
                    do
                        $randomDish = rand(0, $dishesInTheMenuNumber - 1);
                    while (array_search($randomDish, $generatedDishPerOrder) != false);
                    array_push($generatedDishPerOrder, $randomDish);

                    $newDishOrder = new DishOrder();
                    $newDishOrder->dish_id = $restaurants[$i]->dishes[$randomDish]->id;
                    $newDishOrder->quantity = rand(1, 4);
                    $price += $restaurants[$i]->dishes[$randomDish]->price * $newDishOrder->quantity;

                    $newDishOrder->order_id = $newOrder->id;
                    $newDishOrder->save();
                }

                $newOrder->price = $price;
                $newOrder->order_num = substr(sha1($newOrder->id), 0, 8) . $newOrder->id;
                $newOrder->save();
            }
        }
    }
}
