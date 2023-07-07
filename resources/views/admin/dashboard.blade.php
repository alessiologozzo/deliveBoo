@extends('layouts.admin')

@section('content')
    <div class="row pt-4 pb-5 gy-4">
        <div class="col-12 col-md-6 col-xl-3 px-3 px-xl-2 px-xxl-3">
            <a href="{{ route('orders.index') }}" class="d-flex p-4 dashboard-card first-dashboard-card">
                <div>
                    <h4 class="mb-0">My</h4>
                    <h3>Orders</h3>
                </div>

                <div class="w-100 d-flex justify-content-end align-items-center">
                    <i class="fa-solid fa-shopping-cart"></i>
                </div>
            </a>
        </div>

        <div class="col-12 col-md-6 col-xl-3 px-3 px-xl-2 px-xxl-3">
            <a href="{{ route('dishes.index') }}" class="d-flex p-4 dashboard-card second-dashboard-card">
                <div>
                    <h4 class="mb-0">My</h4>
                    <h3>Dishes</h3>
                </div>

                <div class="w-100 d-flex justify-content-end align-items-center">
                    <i class="fa-solid fa-burger"></i>
                </div>
            </a>
        </div>

        <div class="col-12 col-md-6 col-xl-3 px-3 px-xl-2 px-xxl-3">
            <a href="{{route('images.index')}}" class="d-flex p-4 dashboard-card third-dashboard-card">
                <div>
                    <h4 class="mb-0">My</h4>
                    <h3>Images</h3>
                </div>

                <div class="w-100 d-flex justify-content-end align-items-center">
                    <i class="fa-solid fa-images"></i>
                </div>
            </a>
        </div>

        <div class="col-12 col-md-6 col-xl-3 px-3 px-xl-2 px-xxl-3">
            <div class="d-flex dashboard-card fourth-dashboard-card changeable h-100">
                <div class="w-100 d-flex section-1 p-4">
                    <div>
                        <h4 class="mb-0">My</h4>
                        <h3>Profile</h3>
                    </div>

                    <div class="w-100 d-flex justify-content-end align-items-center">
                        <i class="fa-solid fa-gears"></i>
                    </div>
                </div>

                <div class="d-flex section-2 w-100">
                    <a href="{{route('users.index')}}" class="col-6 py-4 d-flex justify-content-center align-items-center">
                        <div class="d-flex flex-column">
                            <h4>User</h4>
                            <i class="fa-solid fa-user fs-2 text-center"></i>
                        </div>
                    </a>

                    <a href="{{route('restaurants.index')}}" class="col-6 py-4 d-flex justify-content-center align-items-center">
                        <div class="d-flex flex-column">
                            <h4>Restaurant</h4>
                            <i class="fa-solid fa-utensils fs-2 text-center"></i>
                        </div>
                    </a>
                </div>

                <div class="w-100 d-flex section-height p-4">
                    <div>
                        <h4 class="mb-0">My</h4>
                        <h3>Restaurant</h3>
                    </div>

                    <div class="w-100 d-flex justify-content-end align-items-center">
                        <i class="fa-solid fa-utensils"></i>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="row pt-4 gy-4">
        <div class="col-12 col-lg-6">
            <div class="chart-container-data dashboard-chart" data-chart-id="line-chart" data-chart-type="line-chart"
                data-chart-data="{{ json_encode($orders) }}" data-chart-title="Orders from the last six months"
                data-chart-label="Orders" data-chart-y-label="Orders Number">
                <canvas id="line-chart"></canvas>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="chart-container-data dashboard-chart" data-chart-id="bar-chart" data-chart-type="bar-chart"
                data-chart-data="{{ json_encode($revenues) }}" data-chart-title="Revenues from the last six months"
                data-chart-label="Revenues" data-chart-y-label="Revenues" data-chart-y-param=" €"
                data-chart-tooltip-extra=" €">
                <canvas id="bar-chart"></canvas>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
