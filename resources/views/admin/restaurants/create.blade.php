@extends('layouts.admin')

@section('page_title')
    New Restaurant
@endsection

<div class="card-body">
    <form class="form" method="POST" action="{{ route('restaurants.store') }}" enctype="multipart/form-data">
        @csrf

        @section('content')
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('New Restaurant') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('restaurants.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-4 row">
                                    <label for="name"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Restaurant Name') }}
                                        <span class="asterisk-opacity">*</span></label>

                                    <div class="col-md-6">
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name') }}" required autocomplete="name" autofocus
                                            maxlength="255">

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4 row">
                                    <label for="address"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Restaurant Address') }} <span
                                            class="asterisk-opacity">*</span></label>

                                    <div class="col-md-6">
                                        <input id="address" type="text"
                                            class="form-control @error('address') is-invalid @enderror" name="address"
                                            value="{{ old('address') }}" required autocomplete="address" autofocus
                                            maxlength="255">

                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="mb-4 row">
                                    <label for="logo"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Logo') }}</label>

                                    <div class="col-md-6">
                                        <input id="logo" type="file"
                                            class="form-control @error('logo') is-invalid @enderror" name="logo">

                                        @error('logo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                createrestaurant
                                <div id="form" class="form-group d-flex justify-content-between align-items-center">
                                    <p class="m-0">Categories:</p>
                                    <div class="d-flex flex-wrap justify-content-center w-100 py-2">
                                        @foreach ($categories as $category)
                                            <div class="px-3">
                                                <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                                    class="form-check-input"
                                                    {{ in_array($category->id, old('category', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label">{{ $category->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('categories')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mt-5 mb-4 row mb-0">
                                    <div class="col-md-6 offset-md-4 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Register') }}
                                        </button>

                                        <div class="mt-5 mb-4 row mb-0">
                                            <div class="col-md-6 offset-md-4 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Register') }}
                                                </button>
                                            </div>
                                            main
                                        </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            createrestaurant
    </div>
@endsection




@endsection
main
