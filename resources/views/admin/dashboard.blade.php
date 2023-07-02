@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Dashboard') }}
    </h2>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('User Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-lg-6">
        <div class="chart-container-data dashboard-chart" data-chart-id="line-chart" data-chart-type="line-chart" data-chart-data="{{json_encode($orders)}}" data-chart-name="Ordini">      
            <canvas id="line-chart"></canvas>
        </div>
    </div>

    <div class="col-12 col-lg-6">
        <div class="chart-container-data dashboard-chart" data-chart-id="bar-chart" data-chart-type="bar-chart" data-chart-data="{{json_encode($orders)}}" data-chart-name="DA DECIDERE">      
            <canvas id="bar-chart"></canvas>
        </div>
    </div>
</div>
  

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection



