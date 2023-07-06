@extends('layouts.admin')

@section('content')
<div id="dish-create" class="container">
    <div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="">
                    @foreach ($errors->all() as $error)
                        <li class="list-group-item">-{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div>
        <form action="{{ route('dishes.store') }}" enctype="multipart/form-data" method="POST" >
            @csrf
            <div class="mb-3">
                <label for="image">Image</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image">
            </div>
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name">
            </div>
            <div class="mb-3">
                <label for="price">Price</label>
                <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" id="price">
            </div>
            <div class="mb-3">
                <label for="category">Category</label>
                <select class="form-select @error('category') is-invalid @enderror"  name="category" id="category">
                    <option value=""></option>
                    @foreach ( $categories as $category)
                    <option value="{{ $category }}">{{ $category }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="description">Description</label>
                <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" id="description">
            </div>
            <div class="mb-3">
                <label for="visible">Visible</label>
                <select class="form-select @error('visible') is-invalid @enderror"  name="visible" id="visible">
                    <option value=""></option>
                    <option value="1">Visible</option>
                    <option value="0">Not visible</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
   
</div>
@endsection