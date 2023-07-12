@extends('layouts.admin')

@section('page_title')
    Images
@endsection

@section('content')
    @if (session()->has('mex'))
        <x-toast-message mex="{{ session()->get('mex') }}" />
    @endif

    <x-modal-ask mex="Are you sure you want to delete this image?" />

    <a href="{{ route('images.create') }}" class="plus-button">
        <i class="fa-solid fa-plus"></i>
    </a>

    <div class="row gy-2 pt-4">
        @for ($i = 0; $i < count($images); $i++)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 p-3">
                <a href="{{ route('images.show', $images[$i]->id) }}" class="img-container d-block">
                    <img src="{{ asset('storage/' . $images[$i]->image) }}" class="img-fill">
                    <div onclick="window.Var.modalFormIndex = {{ $i + 1 }}; event.preventDefault();"
                        data-bs-toggle="modal" data-bs-target="#confirmModal" class="trash-icon">
                        <i class="fa-regular fa-trash-can"></i>
                    </div>
                </a>
            </div>

            <form action="{{ route('images.destroy', $images[$i]->id) }}" method="POST" class="d-none">
                @csrf
                @method('DELETE')
            </form>
        @endfor
    </div>
@endsection
