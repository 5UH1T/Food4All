@extends('layouts.vendor')
@section('vendor_title')
    Products - Vendor
@endsection
@section('vendor_content')
    @include('components.admin.category.deleteModal')
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
    <div class="w-full flex items-center justify-end mb-10">
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

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full text-left">

                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="p-3">S.N.</th>
                        <th class="p-3">Image</th>
                        <th class="p-3">Product</th>
                        <th class="p-3">Main Category</th>
                        <th class="p-3">Category</th>
                        <th class="p-3 text-center">Price</th>
                        <th class="p-3 text-center">Stock</th>
                        <th class="p-3 text-center">Status</th>
                        <th class="p-3 text-end">Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @if ($products->count() == 0)
                        <tr>
                            <td colspan="9" class="p-4 text-center fw-semibold">
                                No Products Found
                            </td>
                        </tr>
                    @else
                        @foreach ($products as $index => $product)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">

                                <td class="p-3">
                                    {{ $products->firstItem() + $index }}
                                </td>

                                <td class="p-3">

                                    @if ($product->mainImage)
                                        <img src="{{ asset($product->mainImage->image_path) }}"
                                            class="rounded h-16 w-16 object-fit-cover">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif

                                </td>

                                <td class="p-3">
                                    {{ $product->title }}
                                </td>

                                <td class="p-3">
                                    {{ $product->categories?->category_name }}
                                </td>

                                <td class="p-3">
                                    {{ $product->subCategories?->sub_category_name }}
                                </td>

                                <td class="p-3 text-center">
                                    Rs. {{ number_format($product->price, 2) }}
                                </td>

                                <td class="p-3 text-center">
                                    {{ $product->stock }}
                                </td>

                                <td class="p-3 text-center">
                                    <span
                                        class="px-3 py-1 rounded-full text-xs fw-semibold
                                    {{ $product->status == 'published' ? 'text-green-600 bg-green-100' : 'text-amber-600 bg-amber-100' }}">
                                        {{ ucfirst($product->status) }}
                                    </span>
                                </td>

                                <td class="p-3 text-end">
                                    <div class="flex justify-end gap-3">

                                        <a href="{{ route('vendor.products.edit', $product->id) }}"
                                            class="w-9 h-9 flex items-center justify-center rounded-lg bg-blue-50 text-blue-600">

                                            <i class="fa-solid fa-pen-to-square"></i>

                                        </a>

                                        <button
                                            class="w-9 h-9 flex items-center justify-center rounded-lg bg-red-50 text-red-600 delete-btn"
                                            data-id="{{ $product->id }}" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal">

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
        {{ $products->links('pagination::bootstrap-5') }}
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.delete-btn').forEach(btn => {

                btn.addEventListener('click', function() {

                    const id = this.dataset.id;

                    document.getElementById('deleteForm').action =
                        `/store/products/${id}`;

                });

            });

        });
    </script>
@endsection
