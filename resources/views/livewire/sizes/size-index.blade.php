@include('dashboard.alerts.alerts')

<div class="container mt-3">
    @include('livewire.sizes.modal2')

    <div class="card">
        <div class="card-header">
            <h3>Colors
                <button type="button" class="btn btn-primary float-end btn-sm text-white" data-bs-toggle="modal"
                    data-bs-target="#basicModal">
                    Add Size
                </button>


            </h3>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>size</th>

                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sizes as $item)

                        <tr>
                            <td>{{ $item->size }}</td>
                            <td>
                                <span class="btn btn-sm round btn-outline-danger" data-id={{ $item->id }}
                                    class="btn btn-danger delete" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal"><i class="fa-solid fa-trash"></i></span>
                            </td>
                        </tr>

                        
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Add Size</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('size.delete', $item->id) }}" method="post" enctype="multipart/form">
                @csrf
                <div class="modal-body">

                    @csrf
                    @method('DELETE')
                    <h5 class="text-center">هل انت متأكد من الحذف</h5>

                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeModal" class="btn btn-outline-secondary"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Save changes</button>
                </div>
            </form>

        </div>
    </div>
</div>

                    @endforeach

                </tbody>

            </table>
        </div>
    </div>
</div>
