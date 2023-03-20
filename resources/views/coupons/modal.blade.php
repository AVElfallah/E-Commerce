<div class="modal modal-danger fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="Delete"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">حذف الكوبون</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('coupon.delete', $item->id) }}" method="post">
                    <input id="id" name="id" hidden>

                    @csrf
                    @method('DELETE')
                    <h5 class="text-center">هل انت متأكد من الحذف</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</button>
                <button type="submit" class="btn btn-sm btn-danger">حذف</button>
            </div>
            </form>
        </div>
    </div>
</div>
