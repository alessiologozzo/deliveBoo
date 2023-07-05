@extends('layouts.admin')

@section('page_title')
    Images
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive mt-3">
                    <table class="table">
                        <thead>
                            <tr class="text-center align-middle">
                                <th scope="col" class="text-white">Restaurant Logo</th>
                                <th scope="col" class="text-white">Name</th>
                                <th scope="col" class="text-white">Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($restaurants as $restaurant)
                                <tr class="text-center align-middle">
                                    <td style="width: 20%">
                                        <img src="{{ asset('storage/' . $restaurant->logo) }}" style="width: 100%">
                                    </td>
                                    <td class="fw-bold" style="width: 20%">{{ $restaurant->name }}</td>
                                    <td style="width: 20%">{{ $restaurant->address }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
