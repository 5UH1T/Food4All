<!-- EDIT MODAL -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-3">

            <!-- HEADER -->
            <div class="modal-header">
                <h5 class="modal-title fw-bold">
                    Edit Category
                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- FORM -->
            <form id="editVendorCategory" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">

                    <!-- TITLE -->
                    <div class="mb-3">
                        <label class="form-label">Category Title</label>
                        <input type="text" name="sub_category_name" id="edit_sub_category_name" class="form-control">
                    </div>

                    <!-- STATUS -->
                    <div>
                        <label class="form-label">Main Category</label>
                        <select name="category_id" id="edit_sub_category_parent" class="form-select">
                            <option value="" selected disabled>-- Select Main Category --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- STATUS -->
                    <div>
                        <label class="form-label">Status</label>
                        <select name="status" id="edit_sub_category_status" class="form-select">
                            <option value="" disabled>-- Select a Status --</option>
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                        </select>
                    </div>
                    <input type="hidden" name="_form" value="edit">

                </div>

                <!-- FOOTER -->
                <div class="modal-footer">

                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>
