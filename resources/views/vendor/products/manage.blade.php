@extends('layouts.vendor')
@section('vendor_title')
    Products - Vendor
@endsection

@section('vendor_content')
    <style>
        html {
            overflow: hidden !important;
        }
    </style>

    <div class="container py-4">

        <div class="mb-4">
            <h2 class="fw-bold">Create Food Product</h2>
            <p class="text-muted">Fill in the details to add a new food item</p>
        </div>

        <form method="POST" enctype="multipart/form-data">
            @csrf

            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body">

                    <div class="row g-4">

                        <div class="col-12">
                            <label class="form-label fw-bold">Title <span class="text-danger">*<span></label>
                            <input type="text" name="name" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Price <span class="text-danger">*<span></label>
                            <input type="number" name="price" class="form-control">
                        </div>


                        <div class="col-md-4">
                            <label class="form-label fw-bold">Stock <span class="text-danger">*<span></label>
                            <input type="number" name="stock" class="form-control">
                        </div>


                        <div class="col-md-4">
                            <label class="form-label fw-bold" title="Price before discount">Initial Price</label>
                            <input type="number" name="price" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Main Category <span class="text-danger">*<span></label>
                            <select name="food_type" class="form-select" required>
                                <option value="" selected disabled>-- Select a Main Category --</option>
                                <option>Vegetarian</option>
                                <option>Non-Vegetarian</option>
                                <option>Vegan</option>
                                <option>Dairy</option>
                                <option>Hard Drinks</option>
                                <option>Soft Drinks</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Category <span class="text-danger">*<span></label>
                            <select name="category" class="form-select" required>
                                <option value="" selected disabled>-- Select a Category --</option>
                                <option>Fast Food</option>
                                <option>Drinks</option>
                                <option>Desserts</option>
                                <option>Main Course</option>
                                <option>Snacks</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Portion</label>
                            <select name="category" class="form-select">
                                <option>Fast Food</option>
                                <option>Drinks</option>
                                <option>Desserts</option>
                                <option>Main Course</option>
                                <option>Snacks</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold">Description <span class="text-danger">*<span></label>
                            <textarea id="editor" name="description" class="form-control" rows="5"></textarea>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold fw-semibold">Product Images <span
                                    class="text-danger">*<span></label>

                            <div class="input-group">
                                <button class="btn btn-primary" type="button" id="lfm" data-input="thumbnail">
                                    Choose Images
                                </button>
                                <input id="thumbnail" class="form-control" type="text" name="images" readonly>
                            </div>
                            <small class="text-muted d-block mt-1">You can select multiple files inside the file manager
                                window.</small>

                            <div id="holder" class="mt-3 d-flex flex-wrap gap-3"></div>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold">Status <span class="text-danger">*<span></label>
                            <select name="availability" class="form-select">
                                <option>Published</option>
                                <option>Draft</option>
                            </select>
                        </div>

                    </div>

                </div>

                <div class="card-footer d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-light border">
                        Cancel
                    </button>

                    <button type="submit" class="btn btn-primary">
                        Save Product
                    </button>
                </div>

            </div>

        </form>

    </div>

    <script src="/ckeditor/ckeditor.js"></script>

    <script>
        if (window.CKEDITOR && document.getElementById('editor')) {
            CKEDITOR.replace('editor');
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

    <script>
        $(document).ready(function() {

            // Initialize UniSharp filemanager setup
            $('#lfm').filemanager('image');

            const input = document.getElementById('thumbnail');
            const holder = document.getElementById('holder');
            let lastValue = '';

            // Render/Sync function
            function renderPreview(force = false) {
                // If the hidden input value hasn't actually altered, skip parsing
                if (input.value === lastValue && !force) return;
                lastValue = input.value;

                holder.innerHTML = '';
                if (!input.value) return;

                // Split UniSharp comma-separated string paths 
                let images = input.value.split(',');

                images.forEach(function(img, index) {
                    img = img.trim();
                    if (!img) return;

                    // Fix asset path routing context variations if necessary
                    if (!img.startsWith('http') && !img.startsWith('/storage') && !img.startsWith('/')) {
                        img = '/storage/' + img;
                    }

                    // Create Wrapper Card Container
                    let wrapper = document.createElement('div');
                    wrapper.className = 'image-preview-item';

                    // Generate Thumbnail
                    let image = document.createElement('img');
                    image.src = img;

                    // Generate Floating Close Action Button
                    let removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.className = 'remove-preview-btn';
                    removeBtn.innerHTML = '&times;';

                    // Button Click Handler to Drop Elements out of string payload array
                    removeBtn.onclick = function() {
                        let currentImages = input.value.split(',').map(item => item.trim());

                        // Remove the item at the specific index
                        currentImages.splice(index, 1);

                        // Update the text input value with remaining values
                        input.value = currentImages.join(',');

                        // Force layout to immediately redraw visually
                        renderPreview(true);
                    };

                    wrapper.appendChild(image);
                    wrapper.appendChild(removeBtn);
                    holder.appendChild(wrapper);
                });
            }

            // Polling interval catches incoming programmatic selections out of UniSharp Popup
            setInterval(function() {
                renderPreview();
            }, 300);
        });
    </script>
@endsection
