<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $restautants = Restaurant::inRandomOrder()->limit(8)->get();
        $data = [
            'categories'=> $categories,
            'restautants'=> $restautants,
        ];
        return response()->json([
            'status' => true,
            'message' => 'Ok',
            'results' => $data
        ], 201);
    }
}
