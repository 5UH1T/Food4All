<!-- UPDATE STATUS MODAL -->
<div class="modal fade" id="updateStatusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-3">

            <!-- HEADER -->
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Update Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body">
                Are you sure you want to update this order status?
            </div>

            <!-- FOOTER -->
            <div class="modal-footer">

                <button type="button" class="btn btn-light border" data-bs-dismiss="modal">
                    Cancel
                </button>

                <form id="updateStatusForm" method="POST">
                    @csrf
                    @method('PATCH')

                    <button type="submit" class="btn btn-success">
                        Update
                    </button>
                </form>

            </div>

        </div>
    </div>
</div>
