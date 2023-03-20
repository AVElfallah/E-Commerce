@extends('dashboard.master')

@section('content')
<!-- // Basic multiple Column Form section start -->
    <div class="container mt-3">

<section id="multiple-column-form">
    <div class="coupon match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{__('admin.edit')}}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form  method="POST" action="{{route('coupon.update' , $coupon->id)}}" class="store form-horizontal" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6 col-12 mb-3">
                                        <div class="form-group">
                                            <label for="first-name-column">{{__('admin.coupon_number')}}</label>
                                            <div class="controls">
                                                <input type="text" name="coupon_num" value="{{$coupon->coupon_num}}" class="form-control" placeholder="{{__('admin.enter_coupon_number')}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12 mb-3">
                                        <div class="form-group">
                                            <label for="first-name-column">{{__('admin.number_of_use')}}</label>
                                            <div class="controls">
                                                <input type="number" name="max_use" value="{{$coupon->max_use}}" class="form-control" placeholder="{{__('admin.enter_number_of_use')}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12 mb-3">
                                        <div class="form-group">
                                            <label for="first-name-column">{{__('admin.discount_type')}}</label>
                                            <div class="controls">
                                                <select name="type" class="select2 form-control" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                    <option value>{{__('admin.select_the_discount_state')}}</option>
                                                    <option {{$coupon->type == 'ratio' ? 'selected' : ''}} value="ratio">{{__('admin.Percentage')}}</option>
                                                    <option {{$coupon->type == 'number' ? 'selected' : ''}} value="number">{{__('admin.fixed_number')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12 mb-3">
                                        <div class="form-group">
                                            <label for="first-name-column">{{__('admin.discount_value')}}</label>
                                            <div class="controls">
                                                <input type="number" value="{{$coupon->discount}}" name="discount" class="discount form-control" placeholder="{{__('admin.type_the_value_of_the_discount')}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12 mb-3">
                                        <div class="form-group">
                                            <label for="first-name-column">{{__('admin.larger_value_for_discount')}}</label>
                                            <div class="controls">
                                                <input readonly type="number" name="max_discount" value="{{$coupon->max_discount}}" class="max_discount form-control" placeholder="{{__('admin.write_the_greatest_value_for_the_discount')}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12 mb-3">
                                        <div class="form-group">
                                            <label for="first-name-column">{{__('admin.expiry_date')}}</label>
                                            <div class="controls">
                                                <input  type="date" value="{{date('Y-m-d', strtotime($coupon->expire_date))}}" name="expire_date" class=" form-control"  required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex  mt-3">
                                        <button type="submit" class="btn btn-primary mr-1 mb-1 submit_button" style="margin-right: 4px;">{{__('admin.update')}}</button>
                                        <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-warning mr-1 mb-1">{{__('admin.back')}}</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>

@endsection

@section('scripts')
 <script>
        $(document).on('change','.select2', function () {
            if ($(this).val() == 'ratio') {
                $('.max_discount').prop('readonly', false);
            }else{
                $('.max_discount').prop('readonly', true);
            }
        });
    </script>
    <script>
        $(document).on('keyup','.discount', function () {
            if ($('.select2').val() == 'number') {
                $('.max_discount').val($(this).val());
            }else{
                if ($(this).val() > 100) {
                    $(this).val(null)
                    toastr.error('{{__('admin.Percentage_must_not_bigger_than_100')}}')
                }
                $('.max_discount').val(null);
            }
        });
        
    </script>
@endsection

