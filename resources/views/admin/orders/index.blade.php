@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="text-center pt-5 pb-5">
            <h1 class="fw-bold text-primary text-uppercase fst-italic">my orders</h1>
        </div>
        <div class="row">
        </div>
        <div class="d-flex justify-content-center mt-3 mb-3">
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
                            @unless (in_array($dish['name'], $dishNames))
                                <option value="{{ $dish['id'] }}" @if ($selectedDish == $dish['id']) selected @endif>
                                    {{ $dish['name'] }}</option>
                                @php
                                    $dishNames[] = $dish['name'];
                                @endphp
                            @endunless
                        @endforeach
                    </select>
                </form>
            </div>
            <div class="mx-3">
                <form method="GET">
                    <label for="searchedOrder" class="form-label">Search your orders by ID!</label>
                    <input name="searchedOrder" id="searchedOrder" class="form-control" placeholder="Type to search...">
                    <div class="mt-3">
                        <button type="submit" class="btn btn-outline-primary">Search</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 mt-4 mb-4">
            @if ($selectedDish)
                @foreach ($restaurants as $restaurant)
                    @foreach ($restaurant->dishes as $dish)
                        @foreach ($dish->orders as $order)
                            @if ($dish['id'] == $selectedDish)
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr class="text-center align-middle">
                                                <th scope="col"></th>
                                                <th scope="col">Dish Name</th>
                                                <th scope="col">Category</th>
                                                <th scope="col">Ingredients</th>
                                                <th scope="col">Order number</th>
                                                <th scope="col">Order date & time</th>
                                                <th scope="col">Order price</th>
                                                <th scope="col">Customer name of the order</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="text-center">
                                                <th scope="row"></th>
                                                <td class="fw-bold">{{ $dish['name'] }}</td>
                                                <td>{{ $dish['category'] }}</td>
                                                <td>{{ $dish['description'] }}</td>
                                                <td>{{ $order['order_num'] }}</td>
                                                <td>{{ $order['date_time'] }}</td>
                                                <td>{{ $order['customer_name'] }}</td>
                                                <td>{{ $order['price'] }} <span>&euro;</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                @endforeach
            @elseif ($searchedOrder)
                @foreach ($orders as $order)
                    @if ($order['id'] == $searchedOrder)
                        <div class="col-12">
                            <div class="card w-50 mx-auto">
                                <div class="card-body text-center">
                                    <div class="card-text order_rectangle p-3">
                                        <h3 class="fw-bold text-white text-uppercase small">
                                            order
                                        </h3>
                                        <div class="pb-3">
                                            <span class="fst-italic text-white">Order ID:</span>
                                            <div class="order_num">{{ $order['id'] }}</div>
                                        </div>
                                        <div class="pb-3">
                                            <span class="fst-italic text-white">Order number:</span>
                                            <div class="order_num">{{ $order['order_num'] }}</div>
                                        </div>
                                        <div>
                                            <span class="fst-italic text-white">Date & Time:</span>
                                            <div class="order_date">{{ $order['date_time'] }}</div>
                                        </div>
                                        <div>
                                            <span class="fst-italic text-white">Price:</span>
                                            <div>{{ $order['price'] }} <span>&euro;</span></div>
                                        </div>
                                        <div>
                                            <span class="fst-italic text-white">Customer
                                                name:</span>
                                            <div class="order_customer">
                                                {{ $order['customer_name'] }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                @foreach ($restaurants as $restaurant)
                    @foreach ($restaurant->dishes as $dish)
                        @foreach ($dish->orders as $order)
                            @php
                                $dishNames = array_diff($dishNames, [$dish['name']]);
                            @endphp
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr class="text-center align-middle">
                                            <th scope="col"></th>
                                            <th scope="col">Dish Name</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Ingredients</th>
                                            <th scope="col">Order number</th>
                                            <th scope="col">Order date & time</th>
                                            <th scope="col">Order price</th>
                                            <th scope="col">Customer name of the order</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center">
                                            <th scope="row"></th>
                                            <td class="fw-bold">{{ $dish['name'] }}</td>
                                            <td>{{ $dish['category'] }}</td>
                                            <td>{{ $dish['description'] }}</td>
                                            <td>{{ $order['order_num'] }}</td>
                                            <td>{{ $order['date_time'] }}</td>
                                            <td>{{ $order['customer_name'] }}</td>
                                            <td>{{ $order['price'] }} <span>&euro;</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    @endforeach
                @endforeach
            @endif
        </div>
    </div>
    {{ $restaurants->links('vendor.pagination.bootstrap-5') }}
    </div>
@endsection
