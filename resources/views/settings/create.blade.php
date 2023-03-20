@extends('dashboard.master')
@section('title')
    add new setting
@endsection
@section('content')
<form action="{{ route('store-settings') }} " method="post" enctype="multipart/form-data">
    @csrf
    <div class="container mt-3">
    <div class="card mb-4">
        <h5 class="card-header">Add setting</h5>
        <div class="card-body">


          <div class="row">
            @foreach (languages() as $lang)
                <div class="col-6 mb-3">
                    <div class="form-group">
                        <div class="controls">
                            <label for="account-name">{{ __('site.title_' . $lang) }} </label>
                            <input class="form-control" value="{{ $setting->getTranslations('footer_desc')[$lang] }}" name="footer_desc[{{ $lang }}]" id=""
                                placeholder="{{ __('site.write') . __('site.title_' . $lang) }}">
                        </div>
                    </div>
                </div>
            @endforeach
              </div>
            <div class="alert-danger">{{ $errors->first('footer_desc') }}</div>



<div class="mb-3">
    <label  class="form-label">facebook link</label>
    <input type="text" value="{{$setting->fb_link}}" class="form-control"  name="fb_link">
  </div>
  <div class="alert-danger">{{ $errors->first('fb_link') }}</div>

  <div class="mb-3">
    <label  class="form-label">instgram link</label>
    <input type="text" value="{{$setting->insta_link}}" class="form-control"  name="insta_link">
  </div>
  <div class="alert-danger">{{ $errors->first('insta_link') }}</div>

  <div class="mb-3">
    <label  class="form-label">twitter link</label>
    <input type="text" value="{{$setting->tw_link}}" class="form-control"  name="tw_link">
  </div>
  <div class="alert-danger">{{ $errors->first('tw_link') }}</div>

  <div class="mb-3">
    <label  class="form-label">youtube link</label>
    <input type="text" value="{{$setting->you_link}}" class="form-control"  name="you_link">
  </div>
  <div class="alert-danger">{{ $errors->first('you_link') }}</div>

  <div class="mb-3">
    <label  class="form-label">whatsapp link</label>
    <input type="text" value="{{$setting->wha_link}}" class="form-control"  name="wha_link">
  </div>
  <div class="alert-danger">{{ $errors->first('wha_link') }}</div>




                    <button type="submit"onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();"
                        class="btn btn-outline-primary">Add</button>
                </div>
            </div>
        </div>
    </form>
@endsection
