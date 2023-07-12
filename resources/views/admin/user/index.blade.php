@extends('layouts.admin')

@section('content')
    @error('password')
        <x-toast-message mex="{{ $message }}" failed />
    @enderror

    @if (session()->has('mex'))
        <x-toast-message mex="{{ session()->get('mex') }}" />
    @endif

    <x-modal-ask route="{{ route('users.destroy', $user->id) }}" method="DELETE"
        mex="Are you sure you want to delete your account?" danger password/>

    <div class="text-center  my-4">
        <h1 class="text-center">User</h1>
    </div>

    <div class="d-flex justify-content-center">
        <div class="card custom-w d-flex flex-column align-items-center" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px">
            <div class="card-body w-100">
                <h5 class="card-title text-center pb-2">{{ $user->first_name }} {{ $user->last_name }}</h5>
                <p class="card-text text-center pb-2">{{ $user->email }}</p>
                <div class="d-flex justify-content-center gap-3 gap-lg-4 flex-wrap pt-3">
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning text-white">EDIT</a>

                    <button data-bs-toggle="modal" data-bs-target="#confirmModal" class="delete-button btn btn-danger text-white">
                        DELETE
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
