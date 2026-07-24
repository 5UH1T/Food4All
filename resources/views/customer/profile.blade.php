@extends('layouts.customer')
@section('customer_title')
    Profile - Customer
@endsection
@section('customer_content')
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
            <h2 class="fw-bold">Your Profile</h2>
            <p class="text-muted">Update your profile information</p>
        </div>

        <form method="POST" id="editUserProfile" enctype="multipart/form-data" action="{{ route('customer.updateProfile') }}">
            @csrf
            @method('PUT')

            <div class="card border-0 shadow-sm rounded-3">

                <div class="card-body">

                    <div class="row g-4">

                        <!-- Name -->
                        <div class="col-md-12">
                            <label class="form-label fw-bold">
                                Full Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="name" name="name" class="form-control" required
                                value="{{ old('name', $user->name ?? '') }}">
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold">
                                Phone <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="phone" class="form-control" id="phone" required
                                value="{{ old('phone', $customer->phone ?? '') }}">
                        </div>

                        <!-- Address -->
                        <div class="col-md-6">
                            <label class="form-label fw-bold">
                                Address <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="address" class="form-control" id="address" required
                                value="{{ old('address', $customer->address ?? '') }}">
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
                                    value="{{ old('avatar', $customer->avatar ?? '') }}">
                            </div>

                            <small class="text-muted">
                                Select your profile image.
                            </small>

                            <div class="mt-3">
                                <img id="holder" src="{{ old('avatar', Storage::url($customer->avatar) ?? '') }}"
                                    style="max-height:180px;border-radius:10px;"
                                    class="{{ old('avatar', $customer->avatar ?? '') ? '' : 'd-none' }}">
                                <small id="removeAvatar"
                                    class="text-red-500 underline cursor-pointer ml-8
                                     {{ old('avatar', $customer->avatar ?? '') ? '' : 'd-none' }}">
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
                refreshPreview();
            }, 300);

        });

        $('#removeAvatar').on('click', function() {

            $('#thumbnail').val('');

            $('#holder')
                .attr('src', '')
                .addClass('d-none');

        });
    </script>
@endsection
