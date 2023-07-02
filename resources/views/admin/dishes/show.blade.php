@extends('layouts.admin')

@section('content')
<div id="dish-show" class="container">

   <div>
      <div class="row mt-4 mb-3">
         <div class="col-4">
            <div class="card p-3">
               <h6>Vendite totali:</h6>
               <p>importo in euro</p>
            </div>
         </div>
         <div class="col-4">
            <div class="card p-3">
               <h6>Oridni totali:</h6>
               <p>ordini totali</p>
            </div>
         </div>
         <div class="col-4">
            <div class="card p-3">
               <h6>N. piatti totali:</h6>
               <p>piatti totlai</p>
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
         <div class="col-6">
            <div class="card">
               <img src="{{ asset('storage/' . $dish->image) }}" alt="">
            </div>
         </div>
         <div class="col-6">
            <div class="">
               <span class="badge text-bg-light">Category 1</span>
               <span class="badge text-bg-light">Category 2</span>
            </div>
            <div class="mt-4">
               <p class="m-0 mb-2">Id: <span>{{ $dish->id }}</span></p>
               <p class="m-0 mb-2">Price: <span>{{ $dish->price }} euro</span></p>
                  @if($dish->price > 0)
                     <p class="m-0 mb-2">Visible: <span>yes</span></p>
                  @else
                     <p class="m-0 mb-2">Visible: <span>no</span></p>
                  @endif
               <p class="m-0 mb-2">Description: <span>{{ $dish->description }}</span></p>

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