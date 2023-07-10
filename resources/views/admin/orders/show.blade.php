@extends('layouts.admin')

@section('page_title')
    Order
@endsection

@section('content')
    <div class="container">
        <h1><span class="text-secondary text-uppercase fw-bold">Order number:</span> {{ $order->order_num }}</h1>
        <h2>
            <span class="text-secondary text-uppercase fw-bold">{{ $order->customer_name }}</span>'s order
        </h2>
        <h2><span class="text-secondary text-uppercase fw-bold">Order ID:</span> {{ $order->id }}</h2>
        <div class="row">
            <div class="col-12">
                <div class="card w-50 mx-auto mt-5">
                    <div class="card-body">
                        <div class="card-text">
                            <div class="text-center">
                                <div>
                                    <div class="fs-1">
                                        <i class="fa-regular fa-user"></i>
                                    </div>
                                    <span class="text-secondary text-uppercase fw-bold">Customer:</span>
                                </div>
                                {{ $order->customer_name }}
                                <div>
                                    <div>
                                        <span class="text-secondary text-uppercase fw-bold">Customer address:</span>
                                    </div>
                                    {{ $order->customer_address }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card w-50 mx-auto mt-3">
                    <div class="card-body">
                        <div class="card-text">
                            <div class="text-center">
                                <div>
                                    <div class="fs-1">
                                        <i class="fa-solid fa-calendar-days"></i>
                                    </div>
                                    <span class="text-secondary text-uppercase fw-bold">Date & Time:</span>
                                </div>
                                {{ $order->date_time }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card w-50 mx-auto mt-3">
                    <div class="card-body">
                        <div class="card-text">
                            <div class="text-center">
                                <div>
                                    <div class="fs-1">
                                        <i class="fa-solid fa-dollar-sign"></i>
                                    </div>
                                    <span class="text-secondary text-uppercase fw-bold">Price:</span>
                                </div>
                                {{ $order->price }} <span>&euro;</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    <h2><span class="text-secondary text-uppercase fw-bold">order dishes</h2>
                    <div class="table-responsive mt-3">
                        <table class="table">
                            <thead>
                                <tr class="text-center align-middle">
                                    <th scope="col" class="text-white rounded-start">Dish Name</th>
                                    <th scope="col" class="text-white">Category</th>
                                    <th scope="col" class="text-white">Description</th>
                                    <th scope="col" class="text-white">Price</th>
                                    <th scope="col" class="text-white rounded-end">Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->dishes as $dish)
                                    <tr class="text-center align-middle">
                                        <th>{{ $dish->name }}</th>
                                        <td>
                                            <span class="badge rounded-pill bg-light text-dark pt-2 pb-2">
                                                {{ $dish->category }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge rounded-pill bg-light text-dark pt-2 pb-2">
                                                {{ $dish->description }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge rounded-pill bg-light text-dark pt-2 pb-2">
                                                {{ $dish->price }} <span>&euro;</span>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('dishes.show', $dish->slug) }}">
                                                <img src="{{ asset('storage/' . $dish->image) }}" style="width: 100%">
                                            </a>
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
@endsection
