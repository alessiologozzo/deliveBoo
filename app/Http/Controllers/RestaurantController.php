<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Restaurant;
use App\Models\User;
use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        $user = Auth::id();
        $users = User::where('id', $user)->get();
        $restaurants = Restaurant::where('user_id', $user)->get();
        return view('admin.restaurants.index', compact('restaurants'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     *
     */
    public function show(Restaurant $restaurant)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     *
     */
    public function edit(Restaurant $restaurant)
    {
        $data = [
            'restaurant' => $restaurant,
        ];
        return view('admin.restaurants.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRestaurantRequest  $request
     * @param  \App\Models\Restaurant  $restaurant
     *
     */
    public function update(UpdateRestaurantRequest $request, Restaurant  $restaurant)
    {
        $data = $request->validated();
        $slug = Str::slug($request->name, '-');
        $data['slug'] = $slug;
        if ($request->has('logo')) {
            if ($restaurant->logo) {
                Storage::delete($restaurant->logo);
            }
            $image_path = Storage::put('images', $request->logo);
            $data['logo'] = $image_path;
        }
        $restaurant->update($data);
        return redirect()->route('admin.restaurants.index', $restaurant->slug);
    }
}
