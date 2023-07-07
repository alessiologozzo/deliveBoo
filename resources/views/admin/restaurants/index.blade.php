@extends('layouts.admin')

@section('content')
    @error('password')
        <div class="al-mex bg-danger">
            {{ $message }}
        </div>
    @enderror

    @if (session()->has('mex'))
        <div class="al-mex">
            {{ session()->get('mex') }}
        </div>
    @endif



    @if (count($restaurants) > 0)
        <x-modal-ask route="{{ route('restaurants.destroy', $restaurants[0]->slug) }}" method="DELETE"
            mex="Are you sure you want to delete your restaurant?" danger password />

        <div class="text-center  my-4">
            <h1 class="text-center">Restaurant</h1>
        </div>

        @foreach ($restaurants as $restaurant)
            <div class=" d-flex justify-content-center">
                <div class="card custom-w d-flex flex-column align-items-center"
                    style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px">

                    @if ($restaurant->logo != null)
                        <img src="{{ asset('storage/' . $restaurant->logo) }}" class="card-img-top w-50 my-3"
                            alt="{{ $restaurant->name }}">
                    @else
                        <h6 class="text-center py-4 px-3">The restaurant does not have a logo.</h6>
                    @endif


                    <div class="card-body w-100">
                        <h5 class="card-title text-center">{{ $restaurant->name }}</h5>
                        <p class="card-text text-center">{{ $restaurant->address }}</p>
                        <div class="d-flex justify-content-center gap-3 gap-lg-4 flex-wrap pt-3">
                            <a href="{{ route('restaurants.edit', $restaurant->slug) }}"
                                class="btn btn-warning text-white">EDIT</a>
                            </a>

                            <button onclick="window.Func.askConfirm(event)" class="delete-button btn btn-danger text-white">
                                DELETE
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="centered-card">
            <span>You don't have a restaurant.</span>

            <div class="pt-4">
                <a href="{{ route('restaurants.create') }}" class="btn btn-primary">Create a new restaurant</a>
            </div>
        </div>
    @endif


@endsection
