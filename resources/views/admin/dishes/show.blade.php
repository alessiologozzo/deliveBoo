@extends('layouts.admin')

@section('page_title')
    Dish
@endsection

@section('content')

    <div id="dish-show" class="container-fluid pb-5">
        <div class="row mt-5">
            <div class="d-flex">
                <p class="fs-3 me-3">{{ $dish->name }}</p>
                <div class="d-flex">
                    <div class="me-2">
                        <a href="{{ route('dishes.edit', $dish->slug) }}" class="btn btn-primary"><i
                                class="fa-solid fa-pen-to-square"></i></a>
                    </div>
                    <div>
                        <form action="{{ route('dishes.destroy', $dish->slug) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type='submit' class="delete-button btn btn-danger text-white"
                                data-item-title="{{ $dish->name }}"> <i class="fa-solid fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xxl-10">
                <div class="row">
                    <!-- col-8 -->
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-7 p-3">
                        <div>
                            <img class="w-100 rounded rounded-3" src="{{ asset('storage/' . $dish->image) }}"
                                alt="{{ $dish->name }}">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-4 p-3">
                        <div class="row">
                            <div class="col-6 pb-4">
                                <div class="card p-3 first-dashboard-card border border-0">
                                    <p class="fs-4 text-white">Revenues (&euro;):</p>
                                    @if (isset($totalAmount))
                                        <p class="m-0 fs-1 text-white">{{ $totalAmount }}<span class="fs-4"> k</span></p>
                                    @else
                                        <p class="m-0 fs-1 text-white">0</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6 pb-4">
                                <div class="card p-3 second-dashboard-card border border-0">
                                    <p class="fs-4 text-white">Orders:</p>
                                    @if (isset($orderCount))
                                        <p class="m-0 fs-1 text-white">{{ $orderCount }}</p>
                                    @else
                                        <p class="m-0 fs-1 text-white">0</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6 pb-4">
                                <div class="card p-3 third-dashboard-card border border-0">
                                    <p class="fs-4 text-white">Dishes sold:</p>
                                    @if (isset($totalDishes))
                                        <p class="m-0 fs-1 text-white">{{ $totalDishes }}</p>
                                    @else
                                        <p class="m-0 fs-1 text-white">0</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6 pb-4">
                                <div class="card p-3 h-100 fourth-dashboard-card border border-0">
                                    <p class="fs-4 text-white">Category:</p>
                                    <div>
                                        <span class="badge text-bg-light">{{ $dish->category }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="card p-3 first-dashboard-card border border-0">
                                <div>
                                    <p class="fs-4 text-white">Description</p>
                                </div>
                                <p class="m-0 mb-2 text-white">Id: <span>{{ $dish->id }}</span></p>
                                <p class="m-0 mb-2 text-white">Price: <span>{{ $dish->price }} euro</span></p>
                                @if ($dish->visible > 0)
                                    <p class="m-0 mb-2 text-white">Visible: <span>yes</span></p>
                                @else
                                    <p class="m-0 mb-2 text-white">Visible: <span>no</span></p>
                                @endif
                                <p class="m-0 mb-2 pe-5 text-white">Description: <span>{{ $dish->description }}</span></p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (strlen($dishes) != 0)
            <div class="row mt-5 mb-5">
                <div class="col-xl-12 col-xxl-8 pe-4">
                    @if (!empty($disheCategory) && strlen($disheCategory) > 0)
                        <div class="mt-3 mb-3">
                            <p class="fs-3">Category relates</p>
                        </div>
                        <div class="row flex-nowrap overflow-auto p-3">
                            @foreach ($disheCategory as $item)
                                <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xxl-3">
                                    <div class="card">
                                        <img class="img-show-category img-fluid rounded-top"
                                            src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}">
                                        <div class="card-body">
                                            {{ Str::limit($item->name, 15, '...') }}
                                            <span
                                                class="badge rounded-pill bg-light text-dark mt-2 pt-2 pb-2">{{ $item->category }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="col-xl-12 col-xxl-4">
                    <div class="mt-3 mb-3">
                        <p class="fs-3">Dishes</p>
                    </div>
                    <div class="card">
                        <div class="height-overflow overflow-auto">
                            <table class="table">
                                <thead class="">
                                    <tr class="">
                                        <th class="text-white rounded-start">Image</th>
                                        <th class="text-white">Name</th>
                                        <th class="text-white rounded-end">Category</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($dishes as $item)
                                        <tr class="">
                                            <td class=""><a href="{{ route('dishes.show', $item->slug) }}"><img
                                                        class="img-table p-1" src="{{ asset('storage/' . $item->image) }}"
                                                        alt="{{ $item->name }}"></a></td>
                                            <th><a class="link-offset-2 link-underline link-underline-opacity-0 d-block pt-2 text-dark"
                                                    href="{{ route('dishes.show', $item->slug) }}">{{ $item->name }}</a>
                                            </th>
                                            <td class=""><span
                                                    class="badge rounded-pill bg-light text-dark mt-2 pt-2 pb-2">{{ $item->category }}</span>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    @include('components.modal-delete')
@endsection
