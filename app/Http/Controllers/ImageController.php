<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all();
        return view('admin.images.index', compact('restaurants'));
    }
}
