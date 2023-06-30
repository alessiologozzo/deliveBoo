@extends('layouts.admin')

@section('content')
    <h1 class="my-4 text-center">Edit User: {{ $user->first_name }} {{ $user->last_name }}</h1>
    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}
    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data"
        class="pb-4">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="first_name">First name</label>
            <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name"
                required maxlength="150" minlength="3" value="{{ old('first_name', $user->first_name) }}">
            @error('first_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="last_name">Last name</label>
            <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name"
                required maxlength="150" minlength="3" value="{{ old('last_name', $user->last_name) }}">
            @error('last_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email">Email</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                required maxlength="150" minlength="3" value="{{ old('email', $user->email) }}">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        {{-- <div class="mb-3">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                <option value="">Seleziona categoria</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $category->id == old('category_id', $restaurant->category_id) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div> --}}
        <button type="submit" class="btn btn-success">Save</button>
        <button type="reset" class="btn btn-primary">Reset</button>
    </form>
@endsection
