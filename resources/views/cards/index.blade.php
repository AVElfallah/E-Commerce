@extends('dashboard.master')

@section('content')
    @include('dashboard.alerts.alerts')

    <div class="container mt-3">

        <div class="card">
            <div class="card-header">
                <h3>Cards
                    <a href="{{ route('cards.create') }}" class="btn btn-primary float-end btn-sm text-white  ">Add
                       card</a>


                </h3>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>title </th>
                            <th>description </th>
                            <th>image</th>
                            <th>actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    
                        @forelse($cards as $card)
                        @include('cards.modal')
                            <tr>
                                <td>  {{$card->title}}  </td>
                                <td>  {{$card->description}}  </td>
                                <td>
                                    <img src="{{asset($card->attachmentRelation[0]->path)}}"width="50" height="50"> 
                                </td>
                                <td>

                                    <a class="btn btn-sm round btn-outline-primary"
                                        href="{{ route('cards.edit', $card->id) }}"><i
                                            class="fa-solid fa-pen-to-square"></i></i>
                                    </a>
                                   
                                    <span class="btn btn-sm round btn-outline-danger" data-id={{ $card->id }}
                                        class="btn btn-danger delete" data-bs-toggle="modal" data-bs-target="#basicModal5"><i
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
