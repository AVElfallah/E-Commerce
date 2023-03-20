@extends('dashboard.master')

@section('title', ' اضافه كوبونات الخصم ')


@section('content')
    <div class="container mt-2">
        <div class="card card-orange">
            <div class="card-header text-white ">
                    <h4 class="card-title">{{__('admin.add')}}</h4>
            </div>
            @if ($errors->any())
                <dv>
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </dv>
            @endif
            <form action="{{ route('coupon.store') }}" method="POST">
                @csrf
                <div class="card-body ">
                                <div class="row">

                                    <div class="col-md-6 col-12 mb-2">
                                        <div class="form-group">
                                            <label class="mb-2" for="first-name-column">{{__('admin.coupon_number')}}</label>
                                            <div class="controls">
                                                <input type="text" name="coupon_num" class="form-control" placeholder="{{__('admin.enter_coupon_number')}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12 mb-2">
                                        <div class="form-group">
                                            <label class="mb-2" for="first-name-column">{{__('admin.number_of_use')}}</label>
                                            <div class="controls">
                                                <input type="number" name="max_use" class="form-control" placeholder="{{__('admin.enter_number_of_use')}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12 mb-2">
                                        <div class="form-group">
                                            <label class="mb-2" for="first-name-column">{{__('admin.discount_type')}}</label>
                                            <div class="controls">
                                                <select name="type" class="select2 form-control type" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                                    <option value>{{__('admin.select_the_discount_state')}}</option>
                                                    <option value="ratio">{{__('admin.Percentage')}}</option>
                                                    <option value="number">{{__('admin.fixed_number')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12 mb-2">
                                        <div class="form-group">
                                            <label class="mb-2" for="first-name-column">{{__('admin.discount_value')}}</label>
                                            <div class="controls">
                                                <input type="number"  name="discount" class="discount form-control" placeholder="{{__('admin.type_the_value_of_the_discount')}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12 mb-2">
                                        <div class="form-group">
                                            <label class="mb-2" for="first-name-column">{{__('admin.larger_value_for_discount')}}</label>
                                            <div class="controls">
                                                <input readonly type="number" name="max_discount" class="max_discount form-control" placeholder="{{__('admin.write_the_greatest_value_for_the_discount')}}" required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12 mb-2">
                                        <div class="form-group">
                                            <label class="mb-2" for="first-name-column">{{__('admin.expiry_date')}}</label>
                                            <div class="controls">
                                                <input  type="date" name="expire_date" class="form-control"  required data-validation-required-message="{{__('admin.this_field_is_required')}}" >
                                            </div>
                                        </div>
                                    </div>

                                    
                                </div>
                </div>


                <div class="card-footer">
                    <button type="submit" class="btn btn-primary text-white ">{{ __('dashboard.add') }}</button>
                </div>
            </form>
        </div>
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
