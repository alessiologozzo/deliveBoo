@extends('layouts.admin')

@section('page_title')
    Orders
@endsection

@section('content')
    <div class="d-flex justify-content-end pb-4">
        <form action="{{ route('orders.index') }}" method="GET" id="ordersForm"
            class="orders-filter w-100 d-flex flex-column gap-3 bg-light p-4" style="max-width: 600px">

            <div class="row">
                <div class="col-12 col-md-6 d-flex flex-column">
                    <label for="orderNum">Filter by order number</label>
                    <input type="text" name="orderNum" id="orderNum" value="{{ $oldOrderNum }}"
                        placeholder="Order number...">
                </div>

                <div class="col-12 col-md-6 d-flex flex-column">
                    <label for="customerName">Filter by customer name</label>
                    <input type="text" name="customerName" id="customerName" value="{{ $oldCustomerName }}"
                        placeholder="Customer name...">
                </div>
            </div>
            <div class="d-flex flex-column">
                <label for="dish">Filter by dish in order</label>
                <select name="dish" id="dish">
                    <option value="all" selected>All</option>
                    @foreach ($dishes as $dish)
                        <option value="{{ $dish->id }}" @if ($oldDish == $dish->id) selected @endif>
                            {{ $dish->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="align-self-end d-flex gap-2 gap-md-3 flex-wrap justify-content-end">
                <input type="submit" onclick="window.Func.resetOrdersFilter(event)" class="btn btn-warning" value="Reset">
                <input type="submit" class="btn btn-primary" value="Filter">
            </div>

            <input type="text" name="orderBy" id="orderBy" class="d-none" value="{{ $oldOrderBy }}">
            <input type="text" name="direction" id="direction" class="d-none" value="{{ $oldDirection }}">
        </form>
    </div>

    <div class="table-responsive box-shadow">
        <table id="ordersTable" class="table table-light table-striped table-bordered table-hover table-link mb-0">
            <thead>
                <tr class="text-center bg-orange">
                    <th class="text-white" data-order-by="orderNum">
                        <div class="d-flex gap-3 justify-content-center align-items-center">
                            <span>Order Number</span>

                            @if (strcmp($oldOrderBy, 'orderNum') == 0 && strcmp($oldDirection, 'desc') == 0)
                                <i class="fa-solid fa-caret-down"></i>
                            @elseif (strcmp($oldOrderBy, 'orderNum') == 0 && strcmp($oldDirection, 'asc') == 0)
                                <i class="fa-solid fa-caret-up"></i>
                            @endif
                        </div>
                    </th>
                    <th class="text-white" data-order-by="customerName">
                        <div class="d-flex gap-3 justify-content-center align-items-center">
                            <span>Customer Name</span>

                            @if (strcmp($oldOrderBy, 'customerName') == 0 && strcmp($oldDirection, 'desc') == 0)
                                <i class="fa-solid fa-caret-down"></i>
                            @elseif (strcmp($oldOrderBy, 'customerName') == 0 && strcmp($oldDirection, 'asc') == 0)
                                <i class="fa-solid fa-caret-up"></i>
                            @endif
                        </div>
                    </th>
                    <th class="text-white" data-order-by="orderDate">
                        <div class="d-flex gap-3 justify-content-center align-items-center">
                            <span>Order Date</span>

                            @if (!$oldOrderBy || (strcmp($oldOrderBy, 'orderDate') == 0 && strcmp($oldDirection, 'desc') == 0))
                                <i class="fa-solid fa-caret-down"></i>
                            @elseif (strcmp($oldOrderBy, 'orderDate') == 0 && strcmp($oldDirection, 'asc') == 0)
                                <i class="fa-solid fa-caret-up"></i>
                            @endif
                        </div>
                    </th>
                    <th class="text-white" data-order-by="orderPrice">
                        <div class="d-flex gap-3 justify-content-center align-items-center">
                            <span>Order Price</span>

                            @if (strcmp($oldOrderBy, 'orderPrice') == 0 && strcmp($oldDirection, 'desc') == 0)
                                <i class="fa-solid fa-caret-down"></i>
                            @elseif (strcmp($oldOrderBy, 'orderPrice') == 0 && strcmp($oldDirection, 'asc') == 0)
                                <i class="fa-solid fa-caret-up"></i>
                            @endif
                        </div>
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($orders as $order)
                    <tr data-location="/orders/{{ $order->id }}" class="text-center">
                        <td>
                            {{ $order->order_num }}
                        </td>

                        <td>
                            {{ $order->customer_name }}
                        </td>

                        <td>
                            {{ $order->date }}
                        </td>

                        <td>{{ $order->price }} &euro;</td>
                    </tr>
                @endforeach

                @if (count($orders) < 1)
                    <tr>
                        <td colspan="4" class="text-center">Your search has no matches in the database.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div class="pagination mt-3 d-flex justify-content-end">
        {{ $orders->links('pagination::bootstrap-5') }}
    </div>
@endsection





{{-- @extends('layouts.admin')

@section('page_title')
    Orders
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mt-3 mb-3">
                <div class="card p-3">
                    <div class="card-body">
                        <div class="card-text">
                            <h3 class="text-uppercase fs-3 text-center fw-bold pb-2">the 5 most expensive orders</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr class="text-center align-middle">
                                            <th scope="col" class="text-white rounded-start">Customer name</th>
                                            <th scope="col" class="text-white">Order ID</th>
                                            <th scope="col" class="text-white rounded-end">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($topExpensive as $order)
                                            <tr class="text-center">
                                                <th>{{ $order->customer_name }}</th>
                                                <td>
                                                    <span class="badge rounded-pill bg-light text-dark pt-2 pb-2">
                                                        {{ $order->id }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge rounded-pill bg-light text-dark pt-2 pb-2">
                                                        {{ $order->price }} &euro;
                                                    </span>
                                                </td>
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
        <div class="d-flex justify-content-center mt-4 mb-3">
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
                                            <th scope="col" class="text-white rounded-start">Dish Name</th>
                                            <th scope="col" class="text-white">Order ID</th>
                                            <th scope="col" class="text-white">Order number</th>
                                            <th scope="col" class="text-white">Order date & time</th>
                                            <th scope="col" class="text-white">Order price</th>
                                            <th scope="col" class="text-white rounded-end">Discover!</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dish->orders as $order)
                                            <tr class="text-center">
                                                <th>{{ $dish->name }}</th>
                                                <td>
                                                    <span class="badge rounded-pill bg-light text-dark pt-2 pb-2">
                                                        {{ $order->id }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge rounded-pill bg-light text-dark pt-2 pb-2">
                                                        {{ $order->order_num }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge rounded-pill bg-light text-dark pt-2 pb-2">
                                                        {{ $order->date_time }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge rounded-pill bg-light text-dark pt-2 pb-2">
                                                        {{ $order->price }} <span>&euro;</span>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge rounded-pill bg-light text-dark pt-2 pb-2">
                                                        <a class="text-dark"
                                                            href="{{ route('orders.show', ['order' => $order->id]) }}">
                                                            <i class="fa-regular fa-eye"></i>
                                                        </a>
                                                    </span>
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
                                    <th scope="col" class="text-white rounded-start">Dish Name</th>
                                    <th scope="col" class="text-white">Order ID</th>
                                    <th scope="col" class="text-white">Order number</th>
                                    <th scope="col" class="text-white">Order date & time</th>
                                    <th scope="col" class="text-white">Order price</th>
                                    <th scope="col" class="text-white rounded-end">Discover!</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr class="text-center">
                                        <th>{{ $dish->name }}</th>
                                        <td>
                                            <span class="badge rounded-pill bg-light text-dark pt-2 pb-2">
                                                {{ $order->id }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge rounded-pill bg-light text-dark pt-2 pb-2">
                                                {{ $order->order_num }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge rounded-pill bg-light text-dark pt-2 pb-2">
                                                {{ $order->date_time }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge rounded-pill bg-light text-dark pt-2 pb-2">
                                                {{ $order->price }} <span>&euro;
                                                </span>
                                        </td>
                                        </span>
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
@endsection --}}
