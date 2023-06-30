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
                                    <span class="fw-bold">Category:</span>
                                    {{ $dish['category'] }}
                                </div>
                                <div class="pb-4">
                                    <span class="fw-bold">Ingredients:</span>
                                    <div>
                                        {{ $dish['description'] }}
                                    </div>
                                </div>
                                <div class="grid-container">
                                    @foreach ($dish->orders as $order)
                                        <div class="rectangle p-3">
                                            <h3 class="fw-bold text-white text-uppercase small">
                                                order informations
                                            </h3>
                                            <div>
                                                <span class="fst-italic text-white">Customer name:</span>
                                                <div>{{ $order['customer_name'] }}</div>
                                            </div>
                                            <div>
                                                <span class="fst-italic text-white">Date & Time:</span>
                                                <div>{{ $order['date_time'] }}</div>
                                            </div>
                                            <div>
                                                <span class="fst-italic text-white">Price:</span>
                                                {{ $order['price'] }}
                                                <span>&euro;</span>
                                            </div>
                                            <div>
                                                <span class="fst-italic text-white">Order number:</span>
                                                <div>{{ $order['order_num'] }}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
