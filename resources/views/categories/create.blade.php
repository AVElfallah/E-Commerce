@extends('dashboard.master')

@section('content')
<form action="{{ route('categories.store') }} " method="post" enctype="multipart/form-data">
    @csrf
    <div class="container mt-3">

        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">new category</h5> 
                    </div>
                <div class="card-body">




           

                    <div class="row">
                        @foreach (languages() as $lang)
                            <div class="col-6 mb-3">
                                <div class="form-group">
                                    <div class="controls">
                                        <label for="account-name">{{ __('site.title_' . $lang) }} </label>
                                        <input class="form-control" name="name[{{ $lang }}]" id=""
                                            placeholder="{{ __('site.write') . __('site.title_' . $lang) }}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="alert-danger">{{ $errors->first('name') }}</div>

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
                        <label class="form-label">image</label></br>
                        <label class="btn btn-primary btn-file">
                            choose image <input type="file" name="attachment" style="display: none;" required>
                        </label>
                    </div>
                    </br>
                    <div class="alert-danger">{{ $errors->first('attachment') }}</div>
                    <button type="submit"onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();"
                        class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </form>
@endsection
