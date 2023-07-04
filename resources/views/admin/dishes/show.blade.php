@extends('layouts.admin')

@section('content')

<div id="dish-show" class="container-fluid pb-5">
   <div class="row mt-5">
      <div class="">
         <p class="fs-3">{{ $dish->name }}</p>
      </div>
      <div class="col-xxl-10">
         <div class="row">
            <!-- col-8 -->
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-7 p-3">
               <div>
                  <img class="w-100" src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name }}">
               </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-4 p-3">
               <div class="row">
                  <div class="col-6 pb-4">
                     <div class="card p-3">
                        <p>Total sell:</p>
                        <p class="m-0 fs-1">{{ $totalAmount }} <span class="fs-5">€</span></p>
                     </div>
                  </div>
                  <div class="col-6 pb-4">
                     <div class="card p-3">
                        <p>Total order:</p>
                        <p class="m-0 fs-1">{{ $orderCount }}</p>
                     </div>
                  </div>
                  <div class="col-6 pb-4">
                     <div class="card p-3">
                        <p>Total dish sell:</p>
                        <p class="m-0 fs-1">{{ $totalDishes }}</p>
                     </div>
                  </div>
                  <div class="col-6 pb-4">
                     <div class="card p-3 h-100">
                        <p>Category:</p>
                        <div>
                           <span class="badge text-bg-light">{{ $dish->category }}</span>
                        </div>
                     </div>
                  </div>
               </div>         
               <div class="">
                  <div class="card p-3">
                     <div>
                        <p class="fs-4">Description Dish</p>
                     </div>      
                     <p class="m-0 mb-2">Id: <span>{{ $dish->id }}</span></p>
                     <p class="m-0 mb-2">Price: <span>{{ $dish->price }} euro</span></p>
                     @if($dish->visible > 0)
                        <p class="m-0 mb-2">Visible: <span>yes</span></p>
                     @else
                        <p class="m-0 mb-2">Visible: <span>no</span></p>
                     @endif
                     <p class="m-0 mb-2 pe-5">Description: <span>{{ $dish->description }}</span></p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row mt-5 mb-5">
      <div class="col-xl-12 col-xxl-8 pe-4">
         <div class="mt-3 mb-3">
            <p class="fs-3">Category relates</p>
         </div>
         <div class="row flex-nowrap overflow-auto p-3">
            @foreach ($disheCategory as $item)   
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xxl-3">
               <div class="card">
                  <img class="img-show-category img-fluid" src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}">
                  <div class="card-body">
                     {{ Str::limit($item->name, 15, '...') }}
                     <span class="badge rounded-pill bg-light text-dark mt-2 pt-2 pb-2">{{ $item->category }}</span>
                  </div>
               </div>
            </div>
            @endforeach
         </div>
      </div>
      <div class="col-xl-12 col-xxl-4">
         <div class="mt-3 mb-3">
            <p class="fs-3">Dishes</p>
         </div>
         <div class="card">
            <div class="height-overflow overflow-auto">
               <table class="table">
                  <thead>
                     <tr>
                        <th class="text-white">Image</th>
                        <th class="text-white">Name</th>
                        <th class="text-white">Category</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($dishes as $item)
                     <tr>
                        <td><a href="{{ route('dishes.show', $item->slug) }}"><img class="img-table p-1" src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}"></a></td>
                        <th><a class="link-offset-2 link-underline link-underline-opacity-0 d-block pt-2 text-dark" href="{{ route('dishes.show', $item->slug) }}">{{ $item->name }}</a></th>
                        <td><span class="badge rounded-pill bg-light text-dark mt-2 pt-2 pb-2">{{ $item->category }}</span></td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection