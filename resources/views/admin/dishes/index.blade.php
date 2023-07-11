@extends('layouts.admin')

@section('content')



<div id="dish-index" class="container-fluid">
  @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
  @endif

  @if($totalDish != 0)
  <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4 mb-5 mt-3">
    <div class="d-flex">
      <form class="d-flex" method="GET" action="{{ route('dishes.index') }}">
        <div class="input-group me-2">
            <input type="text" class="form-control" placeholder="Search your dish" name="search" aria-label="dish" aria-describedby="inputGroup-sizing-default">
        </div>
        <input class="btn btn-primary btn-sm ms-2 me-1" type="submit" value="Search">
      </form>
      <div class="ms-2">
        <a class="btn btn-light text-dark shadow bg-body-tertiary rounded" href="{{ route('dishes.create') }}" role="button">+</a>
      </div>
    </div>
  </div>
  <div class="row mt-4">
    <div class="col-12">
      <div class="row">
        <div class="col-12 col-md-3 col-xl-3 col-xxl-2 pb-4">
          <div class="card p-3 first-dashboard-card border border-0">
            <p class="fs-4 text-white">Total dish:</p>
            <p class="m-0 fs-1 text-white">{{ $totalDish }}</p>
          </div>
        </div>
        <div class="col-12 col-md-3 col-xl-3 col-xxl-2">
          <div class="card p-3 third-dashboard-card border border-0">
            <p class="fs-4 text-white">All category:</p>
            @foreach ($categoryDishes as $item )
            <span class="badge rounded-pill bg-light text-dark mt-2 pt-2 pb-2">
              <div class="d-flex justify-content-between ps-2 pe-2">
                <p class="m-0">{{ $item->category }}</p>
                <p class="m-0">{{ $item->total }}</p>
              </div>
            </span>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
  @if(!empty($searchDish))
  <div class="row mt-5 pt-3">
    <div lass="col-12">
      <div class="card p-3">
        <p class="fs-4">La tua ricerca:</p>
        <table class="table">
          <thead class="table-light">
            <tr class="rounded-top rounded-5">
              <th class="text-white rounded-start">Image</th>
              <th class="text-white">Name</th>
              <th class="d-none d-sm-table-cell text-white">Price</th>
              <th class="text-white">Category</th>
              <th class="d-none d-md-table-cell text-white rounded-end">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><a href="{{ route('dishes.show', $searchDish->slug) }}"><img class="img-table p-1" src="{{ asset('storage/' . $searchDish->image) }}" alt="{{ $searchDish->name }}"></a></td>
              <th><a class="link-offset-2 link-underline link-underline-opacity-0 d-block pt-2 text-dark" href="{{ route('dishes.show', $searchDish->slug) }}">{{ $searchDish->name }}</a></th>
              <td class="d-none d-sm-table-cell">{{ $searchDish->price }} euro</td>
              <td>{{ $searchDish->category }}</td>
              <td class="d-none d-md-table-cell"><a href="{{ route('dishes.show', $searchDish->slug) }}">Show</a></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  @else
  <div class="alert alert-danger mt-4">
    <ul class="">
      <li class="list-group-item">-Nessun risultato corrisponde alla ricerca</li>
    </ul>
  </div>
  @endif
  <div class="row mt-5 pt-3">
    <div class="col-12 col-lg-8 pe-lg-5">
      <div class="card p-3">
        <p class="fs-4">All dishes:</p>
        <table class="table">
          <thead class="table-light">
            <tr class="rounded-top rounded-5">
              <th class="text-white rounded-start">Image</th>
              <th class="text-white">Name</th>
              <th class="d-none d-sm-table-cell text-white">Price</th>
              <th class="text-white">Category</th>
              <th class="d-none d-md-table-cell text-white rounded-end">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($dishes as $item )
            <tr>
              <td><a href="{{ route('dishes.show', $item->slug) }}"><img class="img-table p-1" src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}"></a></td>
              <th><a class="link-offset-2 link-underline link-underline-opacity-0 d-block pt-2 text-dark" href="{{ route('dishes.show', $item->slug) }}">{{ $item->name }}</a></th>
              <td class="d-none d-sm-table-cell">{{ $item->price }} euro</td>
              <td>{{ $item->category }}</td>
              <td class="d-none d-md-table-cell"><a href="{{ route('dishes.show', $item->slug) }}" class="btn btn-primary text-white"><i class="fa-solid fa-eye"></i></a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="pagination mt-3 d-flex justify-content-center">
        {{ $dishes->links('pagination::bootstrap-4') }}
      </div>
    </div>
    <div class="col-12 col-lg-4">
      <div class="row">
        @if($topSellers[0]->orders_count != 0)
        <div class="col-12 mb-5">
          <div class="card p-3">
            <p class="fs-4">Top 5 seller</p>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col" class="text-white rounded-start">Name</th>
                  <th scope="col" class="text-white">Category</th>
                  <th scope="col" class="text-white rounded-end">Orders</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($topSellers as $item)
                <tr>
                  <th><a class="link-offset-2 link-underline link-underline-opacity-0 d-block pt-2 text-dark" href="{{ route('dishes.show', $item->slug) }}">{{ $item->name }}</a></th>
                  <td><span class="badge rounded-pill bg-light text-dark mt-2 pt-2 pb-2">{{ $item->category }}</span></td>
                  <td><span class="badge rounded-pill bg-light text-dark mt-2 pt-2 pb-2">{{ $item->orders_count }}</span></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        @endif
        <div class="col-12">
          <div class="card p-3">
            <p class="fs-4">Top 5 expensive</p>
            <table class="table">
              <thead>
                <tr>
                  <th class="text-white rounded-start" scope="col">Name</th>
                  <th class="text-white" scope="col">Category</th>
                  <th class="text-white rounded-end" scope="col">Orders</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($topExpensive as $item)
                <tr>
                  <th><a class="link-offset-2 link-underline link-underline-opacity-0 d-block pt-2 text-dark" href="{{ route('dishes.show', $item->slug) }}">{{ $item->name }}</a></th>
                  <td><span class="badge rounded-pill bg-light text-dark mt-2 pt-2 pb-2">{{ $item->category }}</span></td>
                  <td><span class="badge rounded-pill bg-light text-dark mt-2 pt-2 pb-2">{{ $item->price }} euro</span></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  @else
  <div class="row mt-5">
    <div class="col-3 mt-3 m-auto">
      <div class="card text-center p-3">
        <p>Il tuo ristorante ({{ $restaurant->name}}) non ha ancora piatti</p>
        <a class="btn btn-primary" href="{{ route('dishes.create') }}" role="button">Crea il tuo primo piatto</a>
      </div>
    </div>
  </div>
  @endif
</div>

@endsection

