<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDishRequest;
use App\Http\Requests\UpdateDishRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;



class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        //selezione ristorante user loggato
        $user = Auth::id();
        $restaurant = Restaurant::where('user_id', $user)->first();
        //dd($restaurant);

        //paginazione piatti
        $dishes = $restaurant->dishes()
        ->paginate(10);

        
        $search = $request->input('search');
        
        if (!empty($search)) {
            $searchDish = $restaurant->dishes()->where('name', $search)->first();
            if ($searchDish && $dishes->contains('id', $searchDish->id)) {
                // La ricerca ha avuto successo, la variabile $searchDish contiene il piatto trovato
            } else {
                $searchDish = 'Nessun risultato corrisponde alla ricerca.';
            }
        } else {
            $searchDish = null;
        }
         

        //dd(!empty($searchDish) && is_string($searchDish));


        //count piatti
        $totalDish = $restaurant->dishes()
        ->count();

        //count categoria e piatti
        $categoryDishes = $restaurant->dishes()
        ->select('category')
        ->selectRaw('COUNT(*) as total')
        ->groupBy('category')
        ->get();

        //top 5 piatti più venduti
        $topSellers = $restaurant->dishes()
        ->withCount('orders')
        ->orderBy('orders_count', 'desc')
        ->limit(5)
        ->get();
        //dd($topSellers);

        //dd($topSellers);  
        
        //top 5 piatti più costosi
        $topExpensive = $restaurant->dishes()
        ->select('*')
        ->orderBy('price', 'desc')
        ->limit(5)
        ->get();

        //dd($topExpensive);



        
        return view('admin.dishes.index', compact('restaurant','dishes','totalDish','categoryDishes','topSellers','topExpensive','searchDish'));
        

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $dishes = Dish::all();
        $categories = Dish::groupBy('category')->pluck('category');
        //dd($categories);
        return view('admin.dishes.create', compact('dishes','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDishRequest $request)
    {
        $data = $request->validated();
        $slug = Str::slug($request->name, '-');
        $data['slug'] = $slug;

        $user = Auth::id();
        $restaurant = Restaurant::where('user_id', $user)->first();
        $data['restaurant_id'] = $restaurant->id;


        if ($request->has('image')) {
            $image = Storage::put('uploads', $request->image);
            $data['image'] = $image;
        }

        $dish = Dish::create($data);

        return redirect()->route('dishes.show', $dish->slug);
    }

    /**
     * Display the specified resource.
     */
    public function show(Dish $dish)
    {
        $orderCount = $dish->orders()->count();

        $totalAmount = $dish->orders()->get()->map(function ($item) use ($dish) {
            return $item->pivot->quantity * $dish->price;
        })->sum();
        $totalDishes = $dish->orders()->get()->sum(function ($item) {
            return $item->pivot->quantity;
        });

        $user = Auth::id();
        $restaurant = Restaurant::where('user_id', $user)->first();
        $dishes = $restaurant->dishes()->where('id','!=', $dish->id )->get();
        //dd($dishes);
        //dd($disheCategory);
        $disheCategory = $restaurant->dishes()->where('category', $dish->category )->whereNotIn('id', [$dish->id])->get();
        
        return view('admin.dishes.show', compact('dish', 'orderCount', 'totalAmount','totalDishes','dishes','disheCategory'));


        

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dish $dish)
    {
        return view('admin.dishes.edit', compact('dish'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDishRequest $request, Dish $dish)
    {
        $data = $request->validated();
        $slug = Str::slug($request->name, '-');
        $data['slug'] = $slug;
        if ($request->has('image')) {
            if ($dish->image) {
                Storage::delete($dish->image);
            }
            $image_path = Storage::put('images', $request->image);
            $data['image'] = $image_path;
        }
        $dish->update($data);
        return redirect()->route('dishes.show', $dish->slug);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dish $dish)
    {
        if ($dish->image) {
            $datogliere = "http://127.0.0.1:8000/storage/";
            $imagetoremove = str_replace($datogliere, '', $dish->image);
            //dd($imagetoremove);
            Storage::delete($dish->image);
        }
        $dish->delete();
        return redirect()->route('dishes.index')->with('message', "$dish->name deleted successfully.");
    }
}
