@extends('layouts.admin')

@section('page_title')
    Orders
@endsection

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center mt-3 mb-3">
            <div class="mx-3">
                <form method="GET">
                    <label for="searchedOrder" class="form-label">Search your orders by ID!</label>
                    <input name="searchedOrder" id="searchedOrder" class="form-control" placeholder="Type to search...">
                    <div class="mt-3">
                        <button type="submit" class="btn btn-outline-primary">Search</button>
                    </div>
                </form>
            </div>
            <div>
                <form method="GET">
                    <label for="selectedDish" class="form-label">Look for the plate!</label>
                    <select name="selectedDish" id="selectedDish" class="form-select" aria-label="Default select example"
                        onchange="this.form.submit()">
                        <option value="">all</option>
                        @php
                            $dishNames = [];
                        @endphp
                        @foreach ($dishes as $dish)
                            @unless (in_array($dish->name, $dishNames))
                                <option value="{{ $dish->id }}" @if ($selectedDish == $dish->id) selected @endif>
                                    {{ $dish->name }}</option>
                                @php
                                    $dishNames[] = $dish->name;
                                @endphp
                            @endunless
                        @endforeach
                    </select>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-4 mb-4">
                @if ($selectedDish)
                    @foreach ($dishes as $dish)
                        @if ($dish->id == $selectedDish)
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr class="text-center align-middle">
                                            <th scope="col"></th>
                                            <th scope="col" class="text-white">Dish Name</th>
                                            <th scope="col" class="text-white">Order ID</th>
                                            <th scope="col" class="text-white">Order number</th>
                                            <th scope="col" class="text-white">Order date & time</th>
                                            <th scope="col" class="text-white">Order price</th>
                                            <th scope="col" class="text-white">Discover!</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dish->orders as $order)
                                            <tr class="text-center">
                                                <th scope="row"></th>
                                                <td class="fw-bold">{{ $dish->name }}</td>
                                                <td>{{ $order->id }}</td>
                                                <td>{{ $order->order_num }}</td>
                                                <td>{{ $order->date_time }}</td>
                                                <td>{{ $order->price }} <span>&euro;</span></td>
                                                <td>
                                                    <a class="text-dark"
                                                        href="{{ route('orders.show', ['order' => $order->id]) }}">
                                                        <i class="fa-regular fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    @endforeach
                @elseif ($searchedOrder)
                    @foreach ($orders as $order)
                        @if ($order->id == $searchedOrder)
                            <div class="col-12">
                                <div class="card w-50 mx-auto">
                                    <div class="card-body text-center">
                                        <div class="card-text order_rectangle p-3">
                                            <h3 class="fw-bold text-white text-uppercase small">
                                                order
                                            </h3>
                                            <div class="pb-3">
                                                <span class="fst-italic text-white">Order ID:</span>
                                                <div class="order_num">{{ $order->id }}</div>
                                            </div>
                                            <div class="pb-3">
                                                <span class="fst-italic text-white">Order number:</span>
                                                <div class="order_num">{{ $order->order_num }}</div>
                                            </div>
                                            <div>
                                                <span class="fst-italic text-white">Date & Time:</span>
                                                <div class="order_date">{{ $order->date_time }}</div>
                                            </div>
                                            <div>
                                                <span class="fst-italic text-white">Price:</span>
                                                <div>{{ $order->price }} <span>&euro;</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="text-center align-middle">
                                    <th scope="col"></th>
                                    <th scope="col" class="text-white">Dish Name</th>
                                    <th scope="col" class="text-white">Order ID</th>
                                    <th scope="col" class="text-white">Order number</th>
                                    <th scope="col" class="text-white">Order date & time</th>
                                    <th scope="col" class="text-white">Order price</th>
                                    <th scope="col" class="text-white">Discover!</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr class="text-center">
                                        <th scope="row"></th>
                                        <td class="fw-bold">{{ $dish->name }}</td>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->order_num }}</td>
                                        <td>{{ $order->date_time }}</td>
                                        <td>{{ $order->price }} <span>&euro;</span></td>
                                        <td>
                                            <a class="text-dark"
                                                href="{{ route('orders.show', ['order' => $order->id]) }}">
                                                <i class="fa-regular fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @if (empty($selectedDish) && empty($searchedOrder))
        {{ $orders->links('vendor.pagination.bootstrap-5') }}
    @endif
@endsection
