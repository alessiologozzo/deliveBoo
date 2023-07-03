@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="text-center pt-5 pb-5">
            <h1 class="fw-bold text-primary text-uppercase fst-italic">my orders</h1>
        </div>
        <div class="row">
            @foreach ($dishes as $dish)
                <div class="col-12 mt-4 mb-4">
                    <div class="card w-100 mx-auto">
                        <div class="card-body text-center">
                            <h3 class="fw-bold text-primary text-uppercase fst-italic">dish informations</h3>
                            <div class="card-title text-uppercase pt-2">
                                <a href="#" class="text-decoration-none text-dark">
                                    <span class="fw-bold">dish name:</span>
                                    <div>
                                        {{ $dish['name'] }}
                                    </div>
                                </a>
                            </div>
                            <div class="card-text">
                                <div>
                                    <span class="fw-bold">Categoryy:</span>
                                    {{ $dish['category'] }}
                                </div>
                                <div class="pb-4">
                                    <span class="fw-bold">Ingredients:</span>
                                    <div>
                                        {{ $dish['description'] }}
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row justify-content-center gy-3">
                                        @foreach ($dish->orders as $order)
                                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                                <div class="card order_rectangle p-3">
                                                    <h3 class="fw-bold text-white text-uppercase small">
                                                        order
                                                    </h3>
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
                                                        <span class="fst-italic text-white">Customer name:</span>
                                                        <div class="order_customer">{{ $order['customer_name'] }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
