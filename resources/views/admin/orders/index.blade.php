@extends('layouts.admin')

@section('page_title')
    Orders
@endsection

@section('content')
    <div class="row gy-4 pt-4">
        <div class="col-12 col-lg-6 col-xl-5 col-xxl-4">
            <div
                class="d-flex flex-column gap-3 align-items-start bg-light p-3 box-shadow border border-secondary overflow-x-auto">
                <h2 class="text-decoration-underline">Summary</h2>

                <div class="d-flex align-items-center gap-3 fs-5">
                    Orders
                    <span class="badge bg-primary fs-3">{{ $ordersTotal }}</span>
                </div>

                <div class="d-flex align-items-center gap-3 fs-4">
                    <span>Revenues<small class="fs-6"> (&euro;)</small></span>
                    <span class="badge bg-success fs-2">{{ $revenuesTotal }} <span class="fs-5">k</span></span>
                </div>

                <div class="d-flex align-items-center gap-3 fs-6">
                    <span>Avg Order/Revenues<small class="fs-6"> (&euro;)</small></span>
                    <span class="badge bg-secondary fs-4">{{ $ordersAvg }}</span>
                </div>

                <hr class="w-100">

                <h2 class="text-decoration-underline">Last Month</h2>

                <div class="d-flex align-items-center gap-3 fs-5">
                    Orders
                    <span class="badge bg-primary fs-3">{{ $ordersLastMonth }}</span>
                </div>

                <div class="d-flex align-items-center gap-3 fs-4">
                    <span>Revenues<small class="fs-6"> (&euro;)</small></span>
                    <span class="badge bg-success fs-2">{{ $revenuesLastMonth }} <span class="fs-5">k</span></span>
                </div>

                <div class="d-flex align-items-center gap-3 fs-6">
                    <span>Avg Order/Revenues<small class="fs-6"> (&euro;)</small></span>
                    <span class="badge bg-secondary fs-4">{{ $revenuesLastMonthAvg }}</span>
                </div>
            </div>

        </div>

        <div class="col-12 col-lg-6 col-xl-7 col-xxl-8">
            <div class="d-flex flex-column gap-3">
                <div class="chart-container-data orders-chart" data-chart-id="total-orders-chart"
                    data-chart-type="line-chart" data-chart-data="{{ json_encode($totalOrdersChart) }}"
                    data-chart-title="Orders" data-chart-label="Orders" data-chart-y-label="Orders Number" data-chart-color="orange">
                    <canvas id="total-orders-chart"></canvas>
                </div>

                <div class="chart-container-data orders-chart" data-chart-id="total-revenues-chart"
                    data-chart-type="bar-chart" data-chart-data="{{ json_encode($totalRevenuesChart) }}"
                    data-chart-title="Revenues" data-chart-label="Revenues" data-chart-y-label="Revenues"
                    data-chart-y-param=" €" data-chart-tooltip-extra=" €" data-chart-color="green">
                    <canvas id="total-revenues-chart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center gy-4 pt-5">
        <div class="col-12 col-lg-6 col-xl-5 col-xxl-4">
            <div
                class="d-flex flex-column gap-3 align-items-start bg-light p-3 box-shadow border border-secondary overflow-x-auto">
                <h2 class="text-decoration-underline">Last Month ({{ $lastMonthDay }})</h2>

                <div class="d-flex align-items-center gap-3 fs-5">
                    Orders
                    <span class="badge bg-primary fs-3">{{ $ordersLastMonthUntil }}</span>
                </div>

                <div class="d-flex align-items-center gap-3 fs-4">
                    <span>Revenues<small class="fs-6"> (&euro;)</small></span>
                    <span class="badge bg-success fs-2">{{ $revenuesLastMonthUntil }} <span class="fs-5">k</span></span>
                </div>

                <div class="d-flex align-items-center gap-3 fs-6">
                    <span>Avg Order/Revenues<small class="fs-6"> (&euro;)</small></span>
                    <span class="badge bg-secondary fs-4">{{ $revenuesLastMonthAvgUntil }}</span>
                </div>

            </div>
        </div>

        <div class="col-12 col-lg-6 col-xl-5 col-xxl-4">
            <div
                class="d-flex flex-column gap-3 align-items-start bg-light p-3 box-shadow border border-secondary overflow-x-auto">
                <h2 class="text-decoration-underline">Current Month</h2>

                <div class="d-flex align-items-center gap-3 fs-5">
                    Orders
                    <span class="badge bg-primary fs-3">{{ $ordersCurrentMonth }}</span>

                    @if ($ordersCurrentMonthPercentage >= 0 && !$lastMonthUntilEmpty)
                        <span class="badge bg-success fs-small"> +{{ $ordersCurrentMonthPercentage }} %</span>
                    @elseif(!$lastMonthUntilEmpty)
                        <span class="badge bg-danger fs-small">{{ $ordersCurrentMonthPercentage }} %</span>
                    @endif
                </div>

                <div class="d-flex align-items-center gap-3 fs-4">
                    <span>Revenues<small class="fs-6"> (&euro;)</small></span>
                    <span class="badge bg-success fs-2">{{ $revenuesCurrentMonth }} <span class="fs-5">k</span></span>
                
                    @if ($revenuesCurrentMonthPercentage >= 0 && !$lastMonthUntilEmpty)
                        <span class="badge bg-success fs-small"> +{{ $revenuesCurrentMonthPercentage }} %</span>
                    @elseif(!$lastMonthUntilEmpty)
                        <span class="badge bg-danger fs-small">{{ $revenuesCurrentMonthPercentage }} %</span>
                    @endif
                </div>

                <div class="d-flex align-items-center gap-3 fs-6">
                    <span>Avg Order/Revenues<small class="fs-6"> (&euro;)</small></span>
                    <span class="badge bg-secondary fs-4">{{ $revenuesCurrentMonthAvg }}</span>

                    @if ($revenuesCurrentMonthAvgPercentage >= 0 && !$lastMonthUntilEmpty)
                        <span class="badge bg-success fs-small"> +{{ $revenuesCurrentMonthAvgPercentage }} %</span>
                    @elseif(!$lastMonthUntilEmpty)
                        <span class="badge bg-danger fs-small">{{ $revenuesCurrentMonthAvgPercentage }} %</span>
                    @endif
                </div>

            </div>
        </div>
    </div>


    <button class="btn btn-outline-primary text-uppercase fs-6 mt-5" onclick="window.Func.toggleSixMonthsCharts(event)">Show</button>
    <div class="sixMonthsCharts row pt-4 gy-4 mt-1">
        <div class="col-12 col-lg-6">
            <div class="chart-container-data dashboard-chart" data-chart-id="line-chart" data-chart-type="line-chart"
                data-chart-data="{{ json_encode($ordersChart) }}" data-chart-title="Orders from the last six months"
                data-chart-label="Orders" data-chart-y-label="Orders Number">
                <canvas id="line-chart"></canvas>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="chart-container-data dashboard-chart" data-chart-id="bar-chart" data-chart-type="bar-chart"
                data-chart-data="{{ json_encode($revenuesChart) }}" data-chart-title="Revenues from the last six months"
                data-chart-label="Revenues" data-chart-y-label="Revenues" data-chart-y-param=" €"
                data-chart-tooltip-extra=" €">
                <canvas id="bar-chart"></canvas>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end pb-4 pt-4">
        <form action="{{ route('orders.index') }}" method="GET" id="ordersForm"
            class="orders-filter w-100 d-flex flex-column gap-3 bg-light p-4" style="max-width: 600px">

            <div class="row">
                <div class="col-12 col-md-6 d-flex flex-column">
                    <label for="orderNum">Filter by Order Number</label>
                    <input type="text" name="orderNum" id="orderNum" value="{{ $oldOrderNum }}"
                        placeholder="Order number...">
                </div>

                <div class="col-12 col-md-6 d-flex flex-column">
                    <label for="customerName">Filter by Customer Name</label>
                    <input type="text" name="customerName" id="customerName" value="{{ $oldCustomerName }}"
                        placeholder="Customer name...">
                </div>
            </div>
            <div class="d-flex flex-column">
                <label for="dish">Filter by Dish</label>
                <select name="dish" id="dish">
                    <option value="all" selected>All</option>
                    @foreach ($dishes as $dish)
                        <option value="{{ $dish->id }}" @if ($oldDish == $dish->id) selected @endif>
                            {{ $dish->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="align-self-end d-flex gap-2 gap-md-3 flex-wrap justify-content-end">
                <input type="submit" onclick="window.Func.resetOrdersFilter(event)" class="btn btn-warning"
                    value="Reset">
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection