@extends('dashboard.master')
@section('title')
    edit product
@endsection
@section('content')
    <form action="{{ url('products/' . $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('Patch')
        <div class="container mt-3">
            <div class="card mb-4">
                <h5 class="card-header">Add new product</h5>
                <div class="card-body">


                    <div class="mb-3">
                        @foreach (languages() as $lang)
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <label for="account-name">{{ __('site.title_' . $lang) }} </label>
                                        <input class="form-control" value="{{ $product->getTranslations('title')[$lang] }}"
                                            name="title[{{ $lang }}]" id=""
                                            placeholder="{{ __('site.write') . __('site.title_' . $lang) }}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mb-3">
                        @foreach (languages() as $lang)
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <label for="account-name">{{ __('site.description_' . $lang) }} </label>
                                        <input class="form-control" name="description[{{ $lang }}]" id=""
                                            cols="30" rows="10"
                                            value="{{ $product->getTranslations('description')[$lang] }}"
                                            placeholder="{{ __('site.write') . __('site.description_' . $lang) }}">
                                    </div>
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
                    <div class="alert-danger">{{ $errors->first('attachment') }}</div>


                    <div class="mb-3">
                        <label for="defaultSelect" class="form-label">category</label>
                        <div class="form-group">
                            <select class="form-control" name="category_id" aria-label="Default select example">
                                <option value="{{ $product->category->id }}">{{ $product->category->name }}</option>
                                @foreach ($categories as $category)
                                    <option value={{ $category->id }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="alert-danger">{{ $errors->first('category_id') }}</div>

                    <div class="mb-3">
                        <label class="form-label">price</label>
                        <input type="number" value="{{ $product->price }}" class="form-control" name="price">
                    </div>
                    <div class="alert-danger">{{ $errors->first('price') }}</div>

                    <div class="mb-3">
                        <select class="selectpicker" name="colors[]" multiple title="Choose colors" data-live-search="true">
                            <optgroup label="Picnic">
                                @foreach ($colors as $color)
                                    <option value="{{ $color->id }}" class="shadow w-50 border-0 rounded-3 mt-1 m-auto"
                                        style="background-color: {{ $color->code }};color:{{ $color->code }}">
                                        {{ $color->name }}
                                    </option>
                                @endforeach
                            </optgroup>

                        </select>


                        <select class="selectpicker" name="sizes[]" multiple title="Choose sizes" data-live-search="true">
                            <optgroup label="Picnic">
                                @foreach ($sizes as $size)
                                    <option value="{{ $size->id }}" class="shadow w-50 border-0 rounded-3 mt-1 m-auto">
                                        {{ $size->size }}
                                    </option>
                                @endforeach
                            </optgroup>

                        </select>


                    </div>



                    <div class="mb-2">
                        <label class="form-label">discount</label>
                        <input type="number" value="{{ $product->tax }}" class="form-control" name="tax">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">quantity</label>
                        <input type="number" value="{{ $product->quantity }}" class="form-control" name="quantity">
                    </div>
                    <div class="alert-danger">{{ $errors->first('tax') }}</div></br>
                    <button type="submit"onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();"
                        class="btn btn-outline-primary">Add</button>
                </div>
            </div>
        </div>






        </div>




    </form>
@endsection

@section('scripts')
    <script>
        'use strict';

        yepnope({
            test: window.jQuery && window.jQuery.fn.button && window.jQuery.fn.selectpicker,
            load: [
                '//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.min.js',
                '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/js/bootstrap.min.js',
                '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/css/bootstrap.min.css',
                '//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.5.4/bootstrap-select.min.js',
                '//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.5.4/bootstrap-select.min.css'
            ],
            complete: function() {
                $(".selectpicker").selectpicker();
            }
        });
    </script>
@endsection
