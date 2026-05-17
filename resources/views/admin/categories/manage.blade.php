@extends('layouts.admin')

@section('admin_title')
    Categories - Admin
@endsection

@section('admin_content')
    @include('components.category.createModal')
    @include('components.category.editModal')
    @include('components.category.deleteModal')

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
    <div class="mb-3">
        <button class="ml-3 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition" data-bs-toggle="modal"
            data-bs-target="#createModal">
            + Create Category
        </button>
    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        <div class="p-4 border-b border-gray-100">
            <h4 class="text-gray-800 text-center">
                Your Categories
            </h4>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">

                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="p-3 text-lg font-semibold text-gray-600">S.N.</th>
                        <th class="p-3 text-lg font-semibold text-gray-600">Category</th>
                        <th class="p-3 text-lg font-semibold text-gray-600">Status</th>
                        <th class="p-3 text-lg font-semibold text-gray-600 text-end">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($categories as $index => $category)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition">

                            <td class="p-3 font-semibold text-gray-700">
                                {{ $index + 1 }}
                            </td>

                            <td class="p-3 text-gray-600">
                                {{ $category->category_name }}
                            </td>

                            <td class="p-3">
                                <span
                                    class="px-3 py-1 rounded-full text-xs font-semibold
                                {{ $category->status === 'published' ? 'text-green-600 bg-green-100' : 'text-amber-600 bg-amber-100' }}">
                                    {{ $category->status }}
                                </span>
                            </td>

                            <!-- ACTIONS -->
                            <td class="p-3 text-right">

                                <div class="flex justify-end gap-3">

                                    <!-- EDIT -->
                                    <button
                                        class="w-9 h-9 flex items-center justify-center rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 edit-btn"
                                        data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{ $category->id }}"
                                        data-name="{{ $category->category_name }}" data-status="{{ $category->status }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>

                                    <!-- DELETE -->
                                    <button
                                        class="w-9 h-9 flex items-center justify-center rounded-lg bg-red-50 text-red-600 hover:bg-red-100 delete-btn"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $category->id }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>

                                </div>

                            </td>

                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Edit Functionality on Modal
            document.querySelectorAll('.edit-btn').forEach(btn => {
                btn.addEventListener('click', function() {

                    const id = this.dataset.id;

                    document.getElementById('edit_category_name').value = this.dataset.name;
                    document.getElementById('edit_status').value = this.dataset.status;

                    document.getElementById('editForm').action =
                        `/admin/categories/${id}`;

                });
            });

            // Delete Functionality on Modal
            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', function() {

                    const id = this.dataset.id;

                    document.getElementById('deleteForm').action =
                        `/admin/categories/${id}`;

                });
            });
        });
    </script>
@endsection
