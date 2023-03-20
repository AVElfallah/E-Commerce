@extends('dashboard.master')

@section('content')
    @include('dashboard.alerts.alerts')

    <div class="container mt-3">

        <div class="card">
            <div class="card-header">
                <h3>offers
                    <a href="{{ route('offers.create') }}" class="btn btn-primary float-end btn-sm text-white  ">Add
                       offer</a>


                </h3>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>title</th>
                            <th>status</th>
                            <th>image</th>
                            <th>actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    
                       @forelse($offers as $offer)
                       @include('offers.modal')
                            <tr>
                                <td> {{ $offer->title }} </td>
                                <td>
                                    
                                      <input data-id="{{$offer->id}}"  type="checkbox" class="toggle-class" data-onstyle="primary" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $offer->status ? 'checked' : '' }}>
                                    
                                    </td>
                                <td><img src="{{asset($offer->attachmentRelation[0]->path)}}"width="50" height="50"> </td>
                               
                               <td>
                                <a class="btn btn-sm round btn-outline-primary"
                                href="{{ route('offers.edit', $offer->id) }}"><i
                                    class="fa-solid fa-pen-to-square"></i></i>
                            </a>

                                <span class="btn btn-sm round btn-outline-danger" data-id={{ $offer->id }}
                                  class="btn btn-danger delete" data-bs-toggle="modal" data-bs-target="#basicModa6"><i
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
               
                <script>
            
                  $(function() {
                
                    $('.toggle-class').change(function() {
                
                        var is_active = $(this).prop('checked') == true ? 1 : 0; 
                
                        var offer_id = $(this).data('id'); 
                
                        $.ajax({
                
                            type: "GET",
                
                            dataType: "json",
                
                            url: '/changeStatus',
                
                            data: {'status': is_active, 'id': offer_id},
                
                            success: function(data){
                
                              console.log(data.success)
                
                            }
                
                        });
                      })
                
                        })
                
                </script>



            </div>
        </div>
    </div>
@endsection


