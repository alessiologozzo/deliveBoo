<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        return view('admin.user.index', ["user" => Auth::user()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     *
     */
    public function show(User $user)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     *
     */
    public function edit(User $user)
    {
        $data = [
            'user' => $user,
        ];
        return view('admin.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\User  $user
     *
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'password' => ['required', 'string', 'max:255', 'current_password'],
            'new_password' => ['nullable', 'string', 'max:255', 'confirmed', Rules\Password::defaults()]
        ]);

        $data = [
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "email" => $request->email,
        ];

        if($request->new_password != null)
            $user->password = Hash::make($request->new_password);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('users.index', $user->id)->with("mex", "Your account has been successfully updated.");
    }

    public function destroy(Request $request, User $user)
    {
        $request->validate([
            "password" => ["required", "string", "max:255", "current_password"]
        ]);

        $restaurant = Restaurant::with(["images", "dishes.orders"])->where("user_id", Auth::id())->first();

        if($restaurant->logo != null)
            Storage::delete($restaurant->logo);
            
        foreach($restaurant->images as $image)
            Storage::delete($image->image);

        foreach($restaurant->dishes as $dish)
            if($dish->image != null)
                Storage::delete($dish->image);

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $user->delete();

        return redirect('/');


    }
}