@extends('dashboard.master')
@section('title')
    edit category
@endsection
@section('content')
    <form action="{{ url('categories/' . $category->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('Patch')
        <div class="container mt-3">
            <div class="card mb-4">
                <h5 class="card-header">Edit category</h5>
                <div class="card-body">

                <div class="row">
                    @foreach (languages() as $lang)
                        <div class="col-6 mb-3">
                            <div class="form-group">
                                <div class="controls">
                                    <label for="account-name">{{ __('site.title_' . $lang) }} </label>
                                    <input class="form-control" value="{{ $category->getTranslations('name')[$lang] }}" name="name[{{ $lang }}]" id=""
                                        placeholder="{{ __('site.write') . __('site.title_' . $lang) }}">
                                </div>
                            </div>
                        @endforeach
                        <div class="alert-danger">{{ $errors->first('name') }}</div>

                    @foreach (languages() as $lang)
                        <div class="col-6 mb-3">
                            <div class="form-group">
                                <div class="controls">
                                    <label for="account-name">{{ __('site.description_' . $lang) }} </label>
                                    <input class="form-control" value="{{ $category->getTranslations('description')[$lang] }}" name="description[{{ $lang }}]" id=""
                                        placeholder="{{ __('site.write') . __('site.description_' . $lang) }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="alert-danger">{{ $errors->first('description') }}</div>
                    <div class="mb-3 ">
                        <label class="form-label">image</label></br>
                        <label class="btn btn-outline-primary btn-file">
                            choose image <input type="file" name="attachment" style="display: none;" required>
                        </label>
                    </div>
                    </br>
                    <div class="alert-danger">{{ $errors->first('attachment') }}</div>




                    <button type="submit"onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();"
                        class="btn btn-outline-primary">Edit</button>








                </div>
                <div class="alert-danger">{{ $errors->first('description') }}</div>
                  <div class="mb-3 ">
                    <label  class="form-label">image</label></br>
                <label class="btn btn-primary btn-file">
                    choose image <input type="file" name="attachment" style="display: none;" required>
                </label>
                </div>
            </br>
                <div class="alert-danger">{{ $errors->first('attachment') }}</div>




                <button type="submit"onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();" class="btn btn-primary">Edit</button>








            </div>
        </div>










    </form>
@endsection
