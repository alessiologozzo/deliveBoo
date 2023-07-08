@extends("layouts.admin")

@section("page_title")
    Image
@endsection

@section("content")
<x-modal-ask mex="Are you sure you want to delete this image?" />

<div class="row justify-content-center align-items-center">
    <div class="col-12 col-lg-9 col-xl-8 box-shadow p-2 bg-dark">
        <img src="{{ asset('storage/' . $image->image) }}" class="img-fill">
    </div>
</div>
<div class="row justify-content-center pt-5">
    <div class="col-12 col-lg-9 col-xl-8 d-flex justify-content-start">
        <div onclick="window.Var.modalFormIndex = 1; window.Func.askConfirm(event);" class="trash-button">
            <i class="fa-regular fa-trash-can"></i>
        </div>
    </div>
</div>

<form action="{{ route('images.destroy', $image->id) }}" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>
@endsection