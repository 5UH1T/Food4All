@extends('layouts.vendor')

@section('vendor_title')
    Store Profile
@endsection

@section('vendor_content')
    <style>
        html {
            overflow: hidden !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                window.notyf.success("{{ session('success') }}");
            @endif

            @if (session('error'))
                window.notyf.error("{{ session('error') }}");
            @endif
        });
    </script>

    <div class="container py-4">

        <div class="mb-4">
            <h2 class="fw-bold">Store Profile</h2>
            <p class="text-muted">Update your business profile information</p>
        </div>

        <form method="POST" id="editVendorProfile" enctype="multipart/form-data" action="{{ route('vendor.updateProfile') }}">
            @csrf
            @method('PUT')

            <div class="card border-0 shadow-sm rounded-3">

                <div class="card-body">

                    <div class="row g-4">

                        <!-- Name -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold">
                                Business Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="name" name="name" class="form-control" required
                                value="{{ old('name', $user->name ?? '') }}">
                        </div>

                        <!-- PAN -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold">
                                PAN Number <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="pan" id="pan" class="form-control" required
                                value="{{ old('pan', $vendor->pan ?? '') }}">
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold">
                                Phone <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="phone" class="form-control" id="phone" required
                                value="{{ old('phone', $vendor->phone ?? '') }}">
                        </div>

                        <!-- Address -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold">
                                Address <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="address" class="form-control" id="address" required
                                value="{{ old('address', $vendor->address ?? '') }}">
                        </div>

                        <!-- Description -->
                        <div class="col-12">
                            <label class="form-label fw-bold">
                                Description
                            </label>

                            <textarea id="editor" name="description" class="form-control" rows="6">{{ old('description', $vendor->description ?? '') }}</textarea>
                        </div>

                        <!-- Google Map -->
                        <div class="col-12">
                            <label class="form-label fw-bold">
                                Google Map Embed Code / Link
                            </label>

                            <textarea name="map" class="form-control" rows="4" id="map" required
                                placeholder="Paste Google Map embed iframe or map link here">{{ old('map', $vendor->map ?? '') }}</textarea>
                        </div>

                        <!-- Avatar -->
                        <div class="col-12">

                            <label class="form-label fw-bold">
                                Avatar
                            </label>

                            <div class="input-group">
                                <button class="btn btn-primary" type="button" id="lfm" data-input="thumbnail">
                                    Choose Image
                                </button>

                                <input id="thumbnail" class="form-control" type="text" name="avatar" readonly hidden
                                    value="{{ old('avatar', $vendor->avatar ?? '') }}">
                            </div>

                            <small class="text-muted">
                                Select your business logo or profile image.
                            </small>

                            <div class="mt-3">
                                <img id="holder" src="{{ old('avatar', Storage::url($vendor->avatar) ?? '') }}"
                                    style="max-height:180px;border-radius:10px;"
                                    class="{{ old('avatar', $vendor->avatar ?? '') ? '' : 'd-none' }}">
                                <small id="removeAvatar"
                                    class="text-red-500 underline cursor-pointer ml-8
                                     {{ old('avatar', $vendor->avatar ?? '') ? '' : 'd-none' }}">
                                    Remove Image
                                </small>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="card-footer d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-primary">
                        Save Profile
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
        $(function() {

            $('#lfm').filemanager('image');

            const input = document.getElementById('thumbnail');
            const holder = document.getElementById('holder');
            const remove = document.getElementById('removeAvatar');

            let previous = input.value;

            function refreshPreview(force = false) {

                if (previous === input.value && !force) return;

                previous = input.value;

                if (input.value) {
                    holder.src = input.value;
                    holder.classList.remove('d-none');
                    remove.classList.remove('d-none');
                } else {
                    holder.src = '';
                    holder.classList.add('d-none');
                    remove.classList.add('d-none');
                }
            }

            setInterval(function() {

                if (input.value !== previous) {

                    let images = input.value
                        .split(',')
                        .map(x => x.trim())
                        .filter(Boolean);

                    if (images.length > 1) {
                        input.value = images[0];
                        window.notyf.error('Only one image is allowed.');
                    }

                    refreshPreview(true);
                }

            }, 300);

        });


        $('#removeAvatar').on('click', function() {

            $('#thumbnail').val('');

            $('#holder')
                .attr('src', '')
                .addClass('d-none');

            $(this).addClass('d-none');

        });
    </script>
@endsection
