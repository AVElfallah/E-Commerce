@extends('dashboard.master')

@section('content')
    @include('dashboard.alerts.alerts')

    <div class="container mt-3">

        <div class="card">
            <div class="card-header">
                <h3>Shipping
                    <a href="{{ route('shippings.create') }}" class="btn btn-primary float-end btn-sm text-white  ">Add
                       shipping</a>


                </h3>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>governorate</th>
                            <th>cost</th>
                           <th>actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    
                       @forelse($shippings as $shipping)
                       @include('shippings.modal')
                            <tr>
                                <td>  {{$shipping->governorate->name}}  </td>
                                <td>  {{$shipping->cost}}  </td>
                                
                                 
                               <td>
                                <a class="btn btn-sm round btn-outline-primary"
                                href="{{ route('shippings.edit', $shipping->id) }}"><i
                                    class="fa-solid fa-pen-to-square"></i></i>
                            </a>

                                <span class="btn btn-sm round btn-outline-danger" data-id={{ $shipping->id }}
                                  class="btn btn-danger delete" data-bs-toggle="modal" data-bs-target="#basicModa8"><i
                                      class="fa-solid fa-trash"></i></span>
                               </td>
                               
                               
                           
                            </tr>
                            @empty
                            <tr class="text-center">
                                <td colspan="7">No Data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
              



            </div>
        </div>
    </div>
















@endsection