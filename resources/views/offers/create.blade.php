@extends('dashboard.master')
@section('title')
add new offer
@endsection
@section('content')
<form action="{{ route('offers.store') }} " method="post" enctype="multipart/form-data">
    @csrf
    <div class="container mt-3">
    <div class="card mb-4">
        <h5 class="card-header">Add new offer</h5>
        <div class="card-body">


            <div class="row">
                @foreach (languages() as $lang)
                    <div class="col-6 mb-3">
                        <div class="form-group">
                            <div class="controls">
                                <label for="account-name">{{ __('site.title_' . $lang) }} </label>
                                <input class="form-control" name="title[{{ $lang }}]" id=""
                                    placeholder="{{ __('site.write') . __('site.title_' . $lang) }}">
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="alert-danger">{{ $errors->first('title') }}</div>

                @foreach (languages() as $lang)
                    <div class="col-6 mb-3">
                        <div class="form-group">
                            <div class="controls">
                                <label for="account-name">{{ __('site.description_' . $lang) }} </label>
                                <input class="form-control" name="description[{{ $lang }}]" id=""
                                    placeholder="{{ __('site.write') . __('site.description_' . $lang) }}">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="alert-danger">{{ $errors->first('description') }}</div>

<div class="mb-3 ">
    <label  class="form-label">image</label></br>
<label class="btn btn-outline-primary btn-file">
    choose image <input type="file" name="attachment" style="display: none;" required>
</label>
</div>
</br>
<div class="alert-danger">{{ $errors->first('attachment') }}</div>

<button type="submit"onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();" class="btn btn-outline-primary">Add</button>
        </div>
    </div>
    </div>
</form>




@endsection