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

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Product Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Brand</label>
                            <input type="text" name="brand" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Category</label>
                            <select name="category" class="form-select">
                                <option>Fast Food</option>
                                <option>Drinks</option>
                                <option>Desserts</option>
                                <option>Main Course</option>
                                <option>Snacks</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Sub Category</label>
                            <input type="text" name="subcategory" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Price</label>
                            <input type="number" name="price" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Discount (%)</label>
                            <input type="number" name="discount" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Stock</label>
                            <input type="number" name="stock" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Food Type</label>
                            <select name="food_type" class="form-select">
                                <option>Vegetarian</option>
                                <option>Non-Vegetarian</option>
                                <option>Vegan</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Spice Level</label>
                            <select name="spice_level" class="form-select">
                                <option>Mild</option>
                                <option>Medium</option>
                                <option>Spicy</option>
                                <option>Extra Spicy</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Preparation Time (mins)</label>
                            <input type="number" name="prep_time" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Portion Size</label>
                            <input type="text" name="portion_size" class="form-control">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea id="editor" name="description" class="form-control" rows="5"></textarea>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Product Images</label>
                            <input type="file" name="images[]" multiple class="form-control">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Tags</label>
                            <input type="text" name="tags" class="form-control">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Availability</label>
                            <select name="availability" class="form-select">
                                <option>Available</option>
                                <option>Out of Stock</option>
                                <option>Pre-Order</option>
                            </select>
                        </div>

                        <div class="col-12 form-check mt-2">
                            <input type="checkbox" name="publish" class="form-check-input" id="publish">
                            <label class="form-check-label" for="publish">
                                Publish Immediately
                            </label>
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

    <script src="/ckeditor/ckeditor.js"></script>
    <script>
        if (window.CKEDITOR && document.getElementById('editor')) {
            CKEDITOR.replace('editor');
        }
    </script>
@endsection
