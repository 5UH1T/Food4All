@extends('layouts.vendor')

@section('vendor_title')
    Categories - vendor
@endsection

@section('vendor_content')
    @include('components.vendor.category.createModal')
    @include('components.vendor.category.editModal')
    @include('components.vendor.category.deleteModal')

    {{-- SUCCESS ALERT --}}
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

    <!-- TOP ACTION -->
    <div class="mb-3 d-flex flex-lg-row flex-column align-items-center justify-content-between w-100">
        <button class="ml-3 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition" data-bs-toggle="modal"
            data-bs-target="#createModal">
            + Create Category
        </button>

        <form method="GET" class="form-outline relative border-1 border-slate-500 rounded-lg overflow-hidden w-[300px]">
            <input type="search" name="search" required placeholder="Search..." value="{{ request('search') }}"
                class="form-control w-100 pr-[55px] rounded-lg" />

            <button type="submit"
                class="bg-primary text-white absolute top-0 right-0 w-[50px] h-100 flex items-center justify-center">

                <i class="fa-solid fa-magnifying-glass"></i>
            </button>

            @if (request('search'))
                <a href="{{ url()->current() }}" class="text-gray-400 absolute right-[55px] top-[50%] translate-y-[-50%]">
                    <i title="Reset" class="fa-solid fa-x text-lg"></i>
                </a>
            @endif
        </form>
    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">

                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="p-3 text-lg font-semibold text-gray-600">S.N.</th>
                        <th class="p-3 text-lg font-semibold text-gray-600">Category</th>
                        <th class="p-3 text-lg font-semibold text-gray-600">Parent Category</th>
                        <th class="p-3 text-lg font-semibold text-gray-600">Status</th>
                        <th class="p-3 text-lg font-semibold text-gray-600 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @if ($subCategories->total() === 0)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                            <td colspan="5" class="p-3 font-semibold text-gray-700 text-center">No Category Found</td>
                        </tr>
                    @else
                        @foreach ($subCategories as $index => $subcategory)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition">

                                <td class="p-3 font-semibold text-gray-700">
                                    {{ $index + 1 }}
                                </td>

                                <td class="p-3 text-gray-600">
                                    {{ $subcategory->sub_category_name }}
                                </td>

                                <td class="p-3 text-gray-600">
                                    {{ $subcategory->categories?->category_name }}
                                </td>

                                <td class="p-3">
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $subcategory->status === 'published' ? 'text-green-600 bg-green-100' : 'text-amber-600 bg-amber-100' }}">
                                        {{ $subcategory->status }}
                                    </span>
                                </td>

                                <!-- ACTIONS -->
                                <td class="p-3 text-right">

                                    <div class="flex justify-end gap-3">

                                        <!-- EDIT -->
                                        <button
                                            class="w-9 h-9 flex items-center justify-center rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 edit-btn"
                                            data-bs-toggle="modal" data-bs-target="#editModal"
                                            data-id="{{ $subcategory->id }}"
                                            data-name="{{ $subcategory->sub_category_name }}"
                                            data-category-id="{{ $subcategory->category_id }}"
                                            data-status="{{ $subcategory->status }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>

                                        <!-- DELETE -->
                                        <button
                                            class="w-9 h-9 flex items-center justify-center rounded-lg bg-red-50 text-red-600 hover:bg-red-100 delete-btn"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal"
                                            data-id="{{ $subcategory->id }}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>

                                    </div>

                                </td>

                            </tr>
                        @endforeach
                    @endif
                </tbody>

            </table>
        </div>
    </div>
    <div class="mt-2">
        {{ $subCategories->links('pagination::bootstrap-5') }}
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Edit Functionality on Modal
            document.querySelectorAll('.edit-btn').forEach(btn => {
                btn.addEventListener('click', function() {

                    const id = this.dataset.id;

                    document.getElementById('edit_sub_category_name').value = this.dataset.name;
                    document.getElementById('edit_sub_category_parent').value = this.dataset
                        .categoryId;
                    document.getElementById('edit_sub_category_status').value = this.dataset.status;

                    document.getElementById('editVendorCategory').action =
                        `/store/categories/${id}`;

                });
            });

            // Delete Functionality on Modal
            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', function() {

                    const id = this.dataset.id;

                    document.getElementById('deleteForm').action =
                        `/store/categories/${id}`;

                });
            });
        });
    </script>
@endsection
