@extends("layouts.admin")

@section("page_title")
    New Image 
@endsection

@section("content")
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('New Image') }}</div>

            <div class="card-body">
                <form method="POST" action="{{ route('images.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4 row">
                        <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }} <span class="asterisk-opacity">*</span></label>

                        <div class="col-md-6">
                            <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" required>

                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-5 mb-4 row mb-0">
                        <div class="col-md-6 offset-md-4 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Save Image') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection