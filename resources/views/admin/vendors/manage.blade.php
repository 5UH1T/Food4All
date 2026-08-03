@extends('layouts.admin')
@section('admin_title')
    Vendors - Admin
@endsection
@section('admin_content')
    @include('components.admin.vendors.viewModal')

    <h2 class="text-center mb-5">All Vendors</h2>
    <div class="mb-3 d-flex align-items-center justify-content-end w-100">
        <form method="GET" class="form-outline relative border-1 border-slate-500 rounded-lg overflow-hidden w-[300px]">
            <input type="search" name="search" required placeholder="Search by name or location"
                value="{{ request('search') }}" class="form-control w-100 pr-[55px] rounded-lg" />

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
            <table class="datatable w-full text-left">

                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="p-3 text-lg font-semibold text-gray-600">#</th>
                        <th class="p-3 text-lg font-semibold text-gray-600">Name</th>
                        <th class="p-3 text-lg font-semibold text-gray-600">Logo</th>
                        <th class="p-3 text-lg font-semibold text-gray-600">Phone</th>
                        <th class="p-3 text-lg font-semibold text-gray-600">Location</th>
                        <th class="p-3 text-lg font-semibold text-gray-600">PAN</th>
                        {{-- <th class="p-3 text-lg font-semibold text-gray-600">Rating</th> --}}
                        <th class="p-3 text-lg font-semibold text-gray-600">Joined</th>
                        <th class="p-3 text-lg font-semibold text-gray-600 text-end">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @if (!$vendors || $vendors->count() === 0)
                        <tr>
                            <td colspan="9" class="p-4 text-center fw-semibold">
                                No Vendors Found
                            </td>
                        </tr>
                    @else
                        @foreach ($vendors as $index => $vendor)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition">

                                <td class="p-3 font-semibold text-gray-700">
                                    {{ 1 + $index }}
                                </td>

                                <td class="p-3 text-gray-600 fw-semibold">
                                    {{ $vendor->name }}
                                </td>

                                <td class="p-3 text-gray-600">
                                    @if ($vendor->vendorProfile->avatar)
                                        <img src="{{ Storage::url($vendor->vendorProfile->avatar) }}"
                                            class="w-12 h-12 object-cover rounded-full">
                                    @else
                                        <div
                                            class="w-12 h-12 object-cover rounded-full bg-black/5 text-black flex items-center justify-center">
                                            -
                                        </div>
                                    @endif
                                </td>

                                <td class="p-3 text-gray-600">
                                    {{ $vendor->vendorProfile->phone }}
                                </td>

                                <td class="p-3 text-gray-600">
                                    @if ($vendor->vendorProfile->map)
                                        <a target="_blank" href="{{ $vendor->vendorProfile->map }}"
                                            class="no-underline text-blue-500">
                                            {{ $vendor->vendorProfile->address }}
                                        </a>
                                    @else
                                        <span>
                                            {{ $vendor->vendorProfile->address }}
                                        </span>
                                    @endif
                                </td>

                                <td class="p-3 text-gray-600">
                                    {{ $vendor->vendorProfile->pan }}
                                </td>

                                {{-- <td class="p-3">
                                <span class="px-3 py-1 rounded-full text-lg font-bold bg-yellow-100 text-yellow-600">
                                    4.5
                                </span>
                            </td> --}}


                                <td class="p-3 text-gray-600">
                                    {{ \Carbon\Carbon::parse($vendor->created_at)->format('F Y') }}
                                </td>

                                <!-- ACTIONS -->
                                <td class="p-3 text-right">
                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#vendorProfileModal{{ $vendor->id }}">
                                        View
                                    </button>
                                </td>

                            </tr>
                        @endforeach
                    @endif
                </tbody>

            </table>
        </div>
    </div>

    @foreach ($vendors as $index => $vendor)
        <div class="modal fade" id="vendorProfileModal{{ $vendor->id }}" tabindex="-1"
            aria-labelledby="vendorProfileModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 rounded-4 shadow-sm">

                    <div class="modal-header border-bottom bg-white px-4 py-3">

                        <div class="d-flex align-items-center gap-3">
                            @if ($vendor->vendorProfile->avatar)
                                <img src="{{ Storage::url($vendor->vendorProfile->avatar) }}" alt="Vendor"
                                    class="rounded-circle border w-16 h-16" style="object-fit: cover;">
                            @endif
                            <div>
                                <h5 class="modal-title fw-semibold mb-1" id="vendorProfileModalLabel">
                                    {{ $vendor->name }}
                                </h5>

                                <div class="text-muted small d-flex flex-wrap gap-3">
                                    <span>
                                        <i class="bi bi-geo-alt"></i>
                                        {{ $vendor->vendorProfile->address }}
                                    </span>

                                    {{-- <span>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    4.8 Rating
                                </span> --}}
                                </div>
                            </div>

                        </div>

                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>

                    </div>

                    <div class="modal-body bg-light p-4">

                        <div class="row g-4">

                            <div class="col-md-8">

                                {{-- <div class="bg-white border rounded-4 p-4 mb-4">
                                
                            </div> --}}

                                <div class="bg-white border rounded-4 p-4 max-h-[500px] overflow-y-auto">

                                    <h6 class="fw-semibold mb-3">
                                        About Vendor
                                    </h6>

                                    <div class="text-muted mb-0 vendor-desc">
                                        @if ($vendor->vendorProfile->description)
                                            {!! $vendor->vendorProfile->description !!}
                                        @else
                                            No description available
                                        @endif
                                    </div>

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="bg-white border rounded-4 p-4 mb-4">

                                    <h6 class="fw-semibold mb-1">
                                        Phone
                                    </h6>

                                    <p class="text-muted mb-3">
                                        {{ $vendor->vendorProfile->phone }}
                                    </p>

                                    <h6 class="fw-semibold mb-1">
                                        PAN No.
                                    </h6>

                                    <p class="text-muted mb-0">
                                        {{ $vendor->vendorProfile->pan }}
                                    </p>

                                </div>

                                <div class="bg-white border rounded-4 p-4">

                                    <h6 class="fw-semibold mb-4">
                                        Statistics
                                    </h6>

                                    <div class="d-flex justify-content-between mb-3">
                                        <span class="text-muted">
                                            Total Orders
                                        </span>

                                        <span class="fw-semibold">
                                            1,240
                                        </span>
                                    </div>

                                    <div class="d-flex justify-content-between mb-3">
                                        <span class="text-muted">
                                            Products
                                        </span>

                                        <span class="fw-semibold">
                                            86
                                        </span>
                                    </div>

                                    <div class="d-flex justify-content-between mb-3">
                                        <span class="text-muted">
                                            Completion Rate
                                        </span>

                                        <span class="fw-semibold text-success">
                                            98%
                                        </span>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">
                                            Joined
                                        </span>

                                        <span class="fw-semibold">
                                            Jan 2024
                                        </span>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="modal-footer bg-white border-top px-4 py-3">
                        <button class="btn btn-light border" data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
@endsection
