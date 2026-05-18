<!-- CREATE MODAL -->
<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-3">

            <!-- HEADER -->
            <div class="modal-header">
                <h5 class="modal-title fw-bold">
                    Create Category
                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- FORM -->
            <form id="createAdminCategory" action="{{ route('admin.createCategory') }}" method="POST">
                @csrf

                <div class="modal-body">

                    <!-- TITLE -->
                    <div class="mb-3">
                        <label class="form-label">Category Title</label>
                        <input type="text" name="category_name" id="create_category_name" class="form-control"
                            placeholder="Soft Drinks">

                        @error('category_name')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- STATUS -->
                    <div>
                        <label class="form-label">Status</label>
                        <select name="status" id="create_category_status" class="form-select">
                            <option value="" selected disabled>-- Select a Status --</option>
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                        </select>
                    </div>

                </div>

                <!-- FOOTER -->
                <div class="modal-footer">

                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>
