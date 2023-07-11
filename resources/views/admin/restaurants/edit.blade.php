@extends('layouts.admin')

@section('page_title')
    Edit Restaurant
@endsection

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Restaurant: {{ $restaurant->name }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('restaurants.update', $restaurant->slug) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-4 row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name <span
                                        class="asterisk-opacity">*</span></label>
                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name', $restaurant->name) }}" required autofocus maxlength="255">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">Address <span
                                        class="asterisk-opacity">*</span></label>
                                <div class="col-md-6">
                                    <input id="address" type="text"
                                        class="form-control @error('address') is-invalid @enderror" name="address"
                                        value="{{ old('address', $restaurant->address) }}" required autofocus
                                        maxlength="255">

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="logo" class="col-md-4 col-form-label text-md-right">Logo</label>
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
                            <div class="mb-4 row mb-0">
                                <div class="col-md-6 offset-md-4 d-flex justify-content-end pt-2">
                                    <button type="submit" class="btn-form">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
