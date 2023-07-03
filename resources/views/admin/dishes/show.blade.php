@extends('layouts.admin')

@section('content')
<div id="dish-show" class="container-fluid">

   <div>
      <div class="row mt-3 mb-3">
         <div class="col-2">
            <div class="card p-3">
               <h6>Vendite totali:</h6>
               <p>{{ $totalAmount }} euro</p>
            </div>
         </div>
         <div class="col-2">
            <div class="card p-3">
               <h6>Oridni totali:</h6>
               <p>{{ $orderCount }}</p>
            </div>
         </div>
         <div class="col-2">
            <div class="card p-3">
               <h6>N. piatti totali:</h6>
               <p>{{ $totalDishes }}</p>
            </div>
         </div>
      </div>
      <div class="row mt-5">
   <div class="d-flex mb-4">
      <h4 class="m-0">{{ $dish->name }}</h4>
      <div class="ms-3">
         <a class="btn btn-primary btn-sm ms-1" href="#" role="button">Edit</a>
         <a class="btn btn-primary btn-sm ms-1" href="#" role="button">Hide</a>
         <a class="btn btn-primary btn-sm ms-1" href="#" role="button">Delete</a>
      </div>
   </div>
   <div class="w-75 d-flex">
      <div class="col-6">
         <div class="card">
            <img src="{{ asset('storage/' . $dish->image) }}" alt="">
         </div>
      </div>
      <div class="col-6 p-3">
         <div class="">
            <span class="badge text-bg-light">{{ $dish->category }}</span>
         </div>
         <div class="mt-4 pe-5">
            <p class="m-0 mb-2">Id: <span>{{ $dish->id }}</span></p>
            <p class="m-0 mb-2">Price: <span>{{ $dish->price }} euro</span></p>
            @if($dish->price > 0)
               <p class="m-0 mb-2">Visible: <span>yes</span></p>
            @else
               <p class="m-0 mb-2">Visible: <span>no</span></p>
            @endif
            <p class="m-0 mb-2 pe-5">Description: <span>{{ $dish->description }}</span></p>
         </div>
      </div>
   </div>
   <div class="w-25 overflow-auto height-overflow">
   <div class="col">
      <div class="card">
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
               @foreach ($dishes as $item)
               <tr>
                  <td><img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}"></td>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->price }} euro</td>
                  <td>{{ $item->category }}</td>
                  <td><a href="{{ route('dishes.show', $item->slug) }}">Show</a></td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
</div>
</div>
      
      <div>
         <h4>Dishes with the same category</h4>
         <div>

         </div>
      </div>
   </div>
</div>
@endsection