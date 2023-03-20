<div class="modal fade" id="basicModa8" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Delete shipping</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('shippings.destroy', ['shipping' => $shipping->id]) }}" method="post">
                    <input id="id" name="id" hidden>

                    @csrf
                    @method('DELETE')
                    <h5 class="text-center">هل انت متأكد من الحذف</h5>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>
            </form>
        </div>
    </div>