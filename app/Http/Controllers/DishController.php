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
    public function index()
    {
        $user = Auth::id();
        $restaurant = Restaurant::where('user_id', $user)->first();
        
        if ($restaurant) {
            $dishes = $restaurant->dishes()->paginate(10);
            return view('admin.dishes.index', compact('dishes'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $dishes = Dish::all();
        return view('admin.dishes.create', compact('dishes'));
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

        return view('admin.dishes.show', compact('dish'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Dish $dish)
    {
        return view('admin.dishes.show', compact('dish'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dish $dish)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dish $dish)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dish $dish)
    {
        //
    }
}
