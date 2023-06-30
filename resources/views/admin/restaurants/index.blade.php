@extends('layouts.admin')

@section('content')
    <div class="text-center  my-4">
        <h1 class="text-center">Restaurant</h1>
    </div>

    {{-- @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif --}}
    @foreach ($restaurants as $restaurant)
    <div class=" d-flex justify-content-center">
        <div class="card w-25 d-flex flex-column align-items-center" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px">
            <img src="{{ asset('storage/' . $restaurant->logo) }}" class="card-img-top w-50 my-3" alt="{{$restaurant->name}}">
            <div class="card-body">
                <h5 class="card-title text-center">{{$restaurant->name}}</h5>
                <p class="card-text text-center">{{$restaurant->address}}</p>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('restaurants.edit', $restaurant->slug) }}"
                        class="btn btn-warning text-white">EDIT</a>
                    <form action="{{ route('restaurants.destroy', $restaurant->slug) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type='submit' class="delete-button btn btn-danger text-white"
                            data-item-title="{{ $restaurant->name }}">DELETE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endforeach

@endsection


