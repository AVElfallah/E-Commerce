@extends('dashboard.master')

@section('title', 'كوبونات الخصم')


@section('content')
    @if (session('success'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
    <div class="container mt-3">

        <div class="card">
            <div class="card-header">
                <h4>
                    {{ __('dashboard.coupones') }}
                    <a href="{{ route('coupon.create') }}" class="btn btn-primary float-end btn-sm text-white">{{ __('dashboard.add') }}</a>
                </h4>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example" class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                <th>{{ __('admin.coupon_number') }}</th>
                            <th>{{__('admin.number_of_use')}}
                            </th>
                <th>{{ __('admin.discount_type') }}</th>
                <th>{{ __('admin.discount_value') }}</th>
                                <th>{{ __('admin.expiry_date') }}</th>

                            <th>{{ __('dashboard.status') }}</th>
                <th>{{ __('dashboard.actions') }}</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse($coupons as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->coupon_num }}</td>
                                <td>{{ $item->use_times }}</td>
                                <td>{{ $item->type == 'ratio' ? 'ratio' : 'fixed' }}</td>
                                <td>{{ $item->discount }}</td>
                                <td>{{ date('d-m-Y', strtotime($item->expire_date)) }}</td>
                                <td>
                                    @if ($item->status == 'available')
                                        <span class="btn btn-sm round btn-outline-success">Available</span>
                                    @elseif($item->status == 'closed')
                                        <span class="btn btn-sm round btn-outline-success">Expired</span>
                                    @endif
                                </td>
                                @include('coupons.modal')

                                <td style="display:inline-flex">
                                    <span style="margin-right: 4px;" class="btn btn-sm round btn-outline-danger mr-2" data-id={{ $item->id }}
                                        class="btn btn-danger delete" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal">{{ __('dashboard.delete') }}</span>
                                 <span class="action-edit text-primary"><a href="{{route('coupon.edit',$item->id)}}" class="btn btn-sm round btn-outline-primary">{{ __('dashboard.edit') }}</i></a></span>

                                </td>

                            </tr>
                        @empty
                        @endforelse
                    </tbody>

                </table>
            </div>
            <!-- /.card-body -->
        </div>


    </div>
    <!-- /.card -->
@endsection

@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: ` Are You Sure  `,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();

                    }
                });
        });
    </script>

    <script>
        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var coupon_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/admin/changeStatus/coupon',
                    data: {
                        'status': status,
                        'banner_id': coupon_id
                    },
                    success: function(data) {
                        console.log(data.success)
                    }
                });
            })
        })
    </script>

    <script>
        $(document).on('click', '.open-coupon', function() {
            $('.coupon_id').val($(this).data('id'))
        })

        $(document).on('click', '.change-coupon-status', function() {
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('coupon.renew') }}",
                data: {
                    id: $(this).data('id'),
                    status: $(this).data('status'),
                    expire_date: $(this).data('date')
                },
                dataType: "json",
                success: (response) => {
                    $(this).parent().html(response.html)
                    Swal.fire({
                        position: 'top-start',
                        type: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500,
                        confirmButtonClass: 'btn btn-primary',
                        buttonsStyling: false,
                    })
                }
            });
        });
    </script>
    <script>
        $(document).on('change', '.select2', function() {
            if ($(this).val() == 'ratio') {
                $('.max_discount').prop('readonly', false);
            } else {
                $('.max_discount').prop('readonly', true);
            }
        });
    </script>
    <script>
        $(document).on('keyup', '.discount', function() {
            if ($('.select2').val() == 'number') {
                $('.max_discount').val($(this).val());
            } else {
                $('.max_discount').val(null);
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('submit', '.notify-form', function(e) {
                e.preventDefault();
                var url = $(this).attr('action')
                $.ajax({
                    url: url,
                    method: 'post',
                    data: new FormData($(this)[0]),
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $(".send-notify-button").html(
                            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
                        ).attr('disable', true)
                    },
                    success: (response) => {
                        $(".text-danger").remove()
                        $('.store input').removeClass('border-danger')
                        $(".send-notify-button").html("{{ __('تعديل') }}").attr(
                            'disable', false)
                        $('#notify').modal('toggle');
                        Swal.fire({
                            position: 'top-start',
                            type: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500,
                            confirmButtonClass: 'btn btn-primary',
                            buttonsStyling: false,
                        })
                        $('#div_' + response.id).parent().html(response.html)
                    },
                    error: function(xhr) {
                        $(".send-notify-button").html("{{ __('تعديل') }}").attr(
                            'disable', false)
                        $(".text-danger").remove()
                        $('.notify-form input').removeClass('border-danger')

                        $.each(xhr.responseJSON.errors, function(key, value) {
                            $('.notify-form input[name=' + key + ']').addClass(
                                'border-danger')
                            $('.notify-form input[name=' + key + ']').after(
                                `<span class="mt-5 text-danger">${value}</span>`);
                            $('.notify-form select[name=' + key + ']').after(
                                `<span class="mt-5 text-danger">${value}</span>`);
                        });
                    },
                });

            });
        });
    </script>
@endsection
