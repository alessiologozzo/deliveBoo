@extends('layouts.admin')

@section('content')
    <div class="text-center  my-4">
        <h1 class="text-center">User</h1>
    </div>

    {{-- @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif --}}
    @foreach ($users as $user)
    <div class=" d-flex justify-content-center">
        <div class="card w-25 d-flex flex-column align-items-center" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px">
            <div class="card-body">
                <h5 class="card-title text-center">{{$user->first_name}} {{$user->last_name}}</h5>
                <p class="card-text text-center">{{$user->email}}</p>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('users.edit', $user->id) }}"
                        class="btn btn-warning text-white">EDIT</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type='submit' class="delete-button btn btn-danger text-white"
                            data-item-title="{{ $user->first_name }}">DELETE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endforeach

@endsection


