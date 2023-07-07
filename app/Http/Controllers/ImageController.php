<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurant = Restaurant::with("images")->where("user_id", Auth::id())->first();

        if(!$restaurant)
            return redirect()->route("restaurants.index");

        return view("admin.images.index", ["images" => $restaurant->images]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.images.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "image" => ["required", "max:255", "mimes:png,jpg,jpeg,svg,webp"]
        ]);

        $restaurant = Restaurant::where("user_id", Auth::id())->first();
        $imagePath = Storage::put("uploads", $request->image);

        $image = new Image;
        $image->image = $imagePath;
        $image->restaurant_id = $restaurant->id;
        $image->save();

        return redirect()->route("images.index")->with("mex", "The image has been uploaded successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        return view("admin.images.show", ["image" => $image]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        Storage::delete($image->image);
        $image->delete();

        return redirect()->route("images.index")->with("mex", "The image has been successfully deleted.");
    }
}
