@extends('dashboard.master')

@section('content')
    @include('dashboard.alerts.alerts')

    <div class="container mt-3">

        <div class="card">
            <div class="card-header">
                <h3>Colors
                    <a href="{{ url('color/create') }}" class="btn btn-primary float-end btn-sm text-white  ">Add
                        color</a>


                </h3>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>Color</th>
                            <th>Code</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($colors as $color)
                            @include('colors.modal')

                            <tr>
                                <td>{{ $color->name }}</td>
                                <td>{{ $color->code }}</td>

                                <td> <input data-id="{{ $color->id }}" class="toggle-class" type="checkbox"
                                        data-onstyle="primary" data-offstyle="danger" data-toggle="toggle" data-on=" Active"
                                        data-off="Inactive" {{ $color->status ? 'checked' : '' }}></td>
                                </td>
                                <td>
                                    <a class="btn btn-sm round btn-outline-primary"
                                        href="{{ route('color.edit', $color->id) }}"><i
                                            class="fa-solid fa-pen-to-square"></i></i>
                                    </a>
                                    <span class="btn btn-sm round btn-outline-danger" data-id={{ $color->id }}
                                        class="btn btn-danger delete" data-bs-toggle="modal" data-bs-target="#basicModal"><i
                                            class="fa-solid fa-trash"></i></span>


                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">No Data</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var color_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: 'change/status/color',
                    data: {
                        'status': status,
                        'color_id': color_id
                    },
                    success: function(data) {
                        console.log(data.success)
                    }
                });
            })
        })
    </script>
@endsection
