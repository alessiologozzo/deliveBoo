@extends('layouts.admin')

@section('content')
<div id="dish-index" class="container">
    <a href="{{ route('dishes.create') }}">crea nuovo piatto</a>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Image</th>
          <th>Name</th>
          <th>Price</th>
          <th>Category</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($dishes as $item )
        <tr>
            <td><img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}"></td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->price }} euro</td>
            <td>{{ $item->category }}</td>
            <td><a href="{{ route('dishes.show', $item->slug) }}">Show</a> <a href="{{ route('dishes.edit', $item->slug) }}">Edit</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div class="pagination">
                {{ $dishes->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
