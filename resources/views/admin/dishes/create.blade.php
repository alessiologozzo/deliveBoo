@extends('layouts.app')

@section('content')
<div id="dish-create" class="container">
<form action="{{ route('dishes.store') }}" enctype="multipart/form-data" method="POST" >
                @csrf
                <div class="mb-3">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" name="image" id="image">
                </div>
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name">
                </div>
                <div class="mb-3">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" name="price" id="price">
                </div>
                <div class="mb-3">
                    <label for="category">Category</label>
                    <input type="text" class="form-control" name="category" id="category">
                </div>
                <div class="mb-3">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" name="description" id="description">
                </div>
                <div class="mb-3">
                    <select class="form-select"  name="visible" id="visible">
                        <option value="0">Visible</option>
                        <option value="1">Not visible</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
   
</div>
@endsection