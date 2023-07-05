@extends('layouts.admin')

@section('content')



<div id="dish-index" class="container-fluid">
  <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4 mb-5 mt-3">
    <div class="d-flex">
      <div class="input-group">
        <input type="text" class="form-control shadow bg-body-tertiary rounded" placeholder="Search your Dish" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        <input class="btn btn-light text-dark shadow bg-body-tertiary rounded ms-2" type="submit" value="Cerca">
      </div>
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
              <td class="d-none d-md-table-cell"><a href="{{ route('dishes.show', $item->slug) }}">Show</a></td>
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
        <div class="col-12">
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
        <div class="col-12 mt-5">
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
</div>





@endsection

