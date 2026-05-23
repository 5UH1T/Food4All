@extends('layouts.admin')
@section('admin_title')
    Vendors - Admin
@endsection
@section('admin_content')
    @include('components.admin.vendors.viewModal')

    <h2 class="text-center mb-5">All Vendors</h2>
    <div class="mb-3 d-flex align-items-center justify-content-end w-100">
        <form method="GET" class="form-outline relative border-1 border-slate-500 rounded-lg overflow-hidden w-[300px]">
            <input type="search" name="search" required placeholder="Search..." value="{{ request('search') }}"
                class="form-control w-100 pr-[55px] rounded-lg" />

            <button type="submit"
                class="bg-primary text-white absolute top-0 right-0 w-[50px] h-100 flex items-center justify-center">

                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="datatable w-full text-left">

                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="p-3 text-lg font-semibold text-gray-600">#</th>
                        <th class="p-3 text-lg font-semibold text-gray-600">Name</th>
                        <th class="p-3 text-lg font-semibold text-gray-600">Logo</th>
                        <th class="p-3 text-lg font-semibold text-gray-600">Location</th>
                        <th class="p-3 text-lg font-semibold text-gray-600">Rating</th>
                        <th class="p-3 text-lg font-semibold text-gray-600">Joined</th>
                        <th class="p-3 text-lg font-semibold text-gray-600 text-end">Action</th>
                    </tr>
                </thead>

                <tbody>
                    {{-- @foreach ($categories as $index => $category) --}}
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition">

                        <td class="p-3 font-semibold text-gray-700">
                            1
                        </td>

                        <td class="p-3 text-gray-600">
                            Kalaiya Sekuwa
                        </td>

                        <td class="p-3 text-gray-600">
                            <img src="https://picsum.photos/200" class="w-12 h-12 object-cover rounded-full">
                        </td>

                        <td class="p-3 text-gray-600">
                            New Baneshwor, Kathmandu
                        </td>

                        <td class="p-3">
                            <span class="px-3 py-1 rounded-full text-lg font-bold bg-yellow-100 text-yellow-600">
                                4.5
                            </span>
                        </td>


                        <td class="p-3 text-gray-600">
                            2026-05-20
                        </td>

                        <!-- ACTIONS -->
                        <td class="p-3 text-right">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#vendorProfileModal">
                                View
                            </button>
                        </td>

                    </tr>
                    {{-- @endforeach --}}
                </tbody>

            </table>
        </div>
    </div>
@endsection
