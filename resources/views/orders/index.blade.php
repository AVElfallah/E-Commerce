@extends('dashboard.master')

@section('content')
    @include('dashboard.alerts.alerts')

    <div class="container mt-3">

        <div class="card">
            <div class="card-header">
                <h3>orders</h3>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>clientName</th>
                            <th>email</th>
                           <th>phone</th>
                           <th>actions</th>

                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    
                       @forelse($orders as $order)
                       
                            <tr>
                                <td>  {{$order->first_name.$order->last_name}}  </td>
                                <td>  {{$order->email}}  </td>
                                <td>  {{$order->phone}}  </td>
                                <td>  
                                    
                                    <a class="btn btn-sm round btn-outline-primary"
                                    href="{{ url('/show-order',$order->id)}}"><i
                                        class="fa-solid fa-bars"></i></i>
                                </a>
                                
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