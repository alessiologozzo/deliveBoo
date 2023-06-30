@extends('layouts.admin')

@section('content')
<div class="d-flex align-items-center flex-column my-5">
    <h1>{{ $restaurant->name }}</h1>
    {{-- @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif --}}
    {{-- <h6>Category: {{ $restaurant->category ? $restaurant->category->name : 'Senza categoria' }}</h6> --}}
    <img src="{{ asset('storage/' . $restaurant->logo) }}" alt="{{ $restaurant->name }}" style="width: 500px" class="my-4">
    <p>{{ $restaurant->address }}</p>
</div>
@endsection
