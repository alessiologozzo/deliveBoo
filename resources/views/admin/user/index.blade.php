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

    <x-modal-ask-password route="{{ route('users.destroy', $user->id) }}" method="DELETE"
        mex="Are you sure you want to delete your account?" danger />

    <div class="text-center  my-4">
        <h1 class="text-center">User</h1>
    </div>

    <div class="d-flex justify-content-center">
        <div class="card w-25 d-flex flex-column align-items-center" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px">
            <div class="card-body">
                <h5 class="card-title text-center pb-2">{{ $user->first_name }} {{ $user->last_name }}</h5>
                <p class="card-text text-center pb-2">{{ $user->email }}</p>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning text-white">EDIT</a>

                    <button onclick="window.Func.askConfirm(event)" class="delete-button btn btn-danger text-white">
                        DELETE
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
