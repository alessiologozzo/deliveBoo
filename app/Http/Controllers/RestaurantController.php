<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Requests\RestaurantRequest;

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
     * @param  \App\Models\Restaurant  $restaurant
     *
     */
    public function update(RestaurantRequest $request, Restaurant $restaurant)
    {
        $validated = $request->validated();
        $validated = array_merge($validated, ["slug" => Str::slug($validated["name"]) . "-" . Auth::id()]);

        if($request->has("logo")){
            if($restaurant->logo != null)
                Storage::delete($restaurant->logo);
            
            $imagePath = Storage::put("uploads", $request->logo);
            $validated = array_merge($validated, ["logo" => $imagePath]);
        }

        $restaurant->update($validated);

        return redirect()->route("restaurants.index")->with("mex", "Your restaurant has been updated.");
    }

    public function destroy(Request $request, $slug){
        $request->validate([
            "password" => ["required", "string", "max:255", "current_password"]
        ]);

        $restaurant = Restaurant::with(["images", "dishes"])->where("slug", $slug)->first();

        if($restaurant->logo != null)
            Storage::delete($restaurant->logo);
            
        foreach($restaurant->images as $image)
            Storage::delete($image->image);

        foreach($restaurant->dishes as $dish)
            if($dish->image != null)
                Storage::delete($dish->image);

        $restaurant->delete();

        return redirect()->route("restaurants.index")->with("mex", "Your restaurant has been deleted.");
    }

    public function create(){
        return view("admin.restaurants.create");
    }

    public function store(RestaurantRequest $request){
        $validated = $request->validated();
        $restaurant = new Restaurant();
        $restaurant->name = $validated["name"];
        $restaurant->address = $validated["address"];
        $restaurant->slug = Str::slug($restaurant->name) . "-" . Auth::id();
        $restaurant->user_id = Auth::id();
        if($request->logo != null){
            $imagePath = Storage::put("uploads", $validated["logo"]);
            $restaurant->logo = $imagePath;
        }
        $restaurant->save();

        return redirect()->route("restaurants.index")->with("mex", "You have successfully created a new restaurant.");
    }
}
