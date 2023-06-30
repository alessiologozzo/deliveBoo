@extends('layouts.admin')

@section('content')
    <div class="text-center">
        <h1 class="text-center">Restaurant List</h1>

        {{-- <a class="btn btn-success text-white" href="{{ route('admin.restaurants.create') }}">New Restaurant</a> --}}

    </div>

    {{-- @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif --}}
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Logo</th>
                <th scope="col">Address</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($restaurants as $restaurant)
                <tr>
                    <th scope="row">{{ $restaurant->id }}</th>
                    <td>{{ $restaurant->name }}</td>
                    <td><img class="img-thumbnail bg-secondary" style="width:100px" class="bg-black" src="{{ asset('storage/' . $restaurant->logo) }}"
                            alt="{{ $restaurant->name }}">
                    </td>
                    <td>{{ $restaurant->address }}</td>
                    {{-- <td>
                        {{ $restaurant->category ? $restaurant->category->name : 'Senza categoria' }}
                    </td> --}}
                    <td>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('admin.restaurants.show', $restaurant->slug) }}"
                                class="btn btn-primary text-white">SHOW</a>
                            <a href="{{ route('admin.restaurants.edit', $restaurant->slug) }}"
                                class="btn btn-warning text-white">EDIT</a>
                            <form action="{{ route('admin.restaurants.destroy', $restaurant->slug) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type='submit' class="delete-button btn btn-danger text-white"
                                    data-item-title="{{ $restaurant->name }}">DELETE</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
