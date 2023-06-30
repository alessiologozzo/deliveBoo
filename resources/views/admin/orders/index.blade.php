@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="text-center pt-5 pb-5">
            <h1 class="fw-bold text-primary text-uppercase fst-italic">orders</h1>
        </div>
        <div class="row pb-5">
            @foreach ($generatedOrdersNumber as $order)
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 mt-4 mb-4">
                    <div class="card w-100 mx-auto">
                        <div class="card-body">
                            <div class="card-title text-uppercase fw-bold text-center pt-2">
                                <a href="#" class="text-decoration-none text-dark">
                                    {{ $order['customer_name'] }}
                                </a>
                            </div>
                            <div class="card-text text-center">
                                <div>Customer Address:
                                    <span class="text-secondary">{{ $order['customer_address'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
