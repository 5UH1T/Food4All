@extends('layouts.admin')
@section('admin_title')
    Users - Admin
@endsection
@section('admin_content')
    @include('components.admin.users.viewModal')

    <h2 class="text-center mb-5">All Users</h2>
    <div class="mb-3 d-flex align-items-center justify-content-end w-100">
        <form method="GET" class="form-outline relative border-1 border-slate-500 rounded-lg overflow-hidden w-[300px]">
            <input type="search" name="search" required placeholder="Search by name..." value="{{ request('search') }}"
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
            <table class="datatable w-full text-left">

                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="p-3 text-lg font-semibold text-gray-600">#</th>
                        <th class="p-3 text-lg font-semibold text-gray-600">Name</th>
                        <th class="p-3 text-lg font-semibold text-gray-600">Image</th>
                        <th class="p-3 text-lg font-semibold text-gray-600">Address</th>
                        <th class="p-3 text-lg font-semibold text-gray-600">Phone</th>
                        <th class="p-3 text-lg font-semibold text-gray-600">Joined</th>
                        <th class="p-3 text-lg font-semibold text-gray-600 text-end">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @if (!$users || $users->count() === 0)
                        <tr>
                            <td colspan="9" class="p-4 text-center fw-semibold">
                                No User Found
                            </td>
                        </tr>
                    @else
                        @foreach ($users as $index => $user)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition">

                                <td class="p-3 font-semibold text-gray-700">
                                    {{ 1 + $index }}
                                </td>

                                <td class="p-3 text-gray-600">
                                    {{ $user->name }}
                                </td>

                                <td class="p-3 text-gray-600">
                                    @if ($user->profile->avatar)
                                        <img src="{{ Storage::url($user->profile->avatar) }}"
                                            class="w-12 h-12 object-cover rounded-full">
                                    @else
                                        <div
                                            class="w-12 h-12 object-cover rounded-full bg-black/5 text-black flex items-center justify-center">
                                            -
                                        </div>
                                    @endif
                                </td>

                                <td class="p-3 text-gray-600">
                                    {{ $user->profile->address }}
                                </td>


                                <td class="p-3 text-gray-600">
                                    {{ $user->profile->phone }}
                                </td>

                                <td class="p-3 text-gray-600">
                                    {{ \Carbon\Carbon::parse($user->created_at)->format('F Y') }}
                                </td>

                                <!-- ACTIONS -->
                                <td class="p-3 text-right">
                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#userProfileModal{{ $user->id }}">
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

    @foreach ($users as $index => $user)
        <div class="modal fade" id="userProfileModal{{ $user->id }}" tabindex="-1"
            aria-labelledby="userProfileModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 rounded-4 shadow-sm">

                    <div class="modal-header border-bottom bg-white px-4 py-3">

                        <div class="d-flex align-items-center gap-3">
                            @if ($user->profile->avatar)
                                <img src="{{ Storage::url($user->profile->avatar) }}" alt="User"
                                    class="rounded-circle border w-16 h-16"style="object-fit: cover;">
                            @endif
                            <div>
                                <h5 class="modal-title fw-semibold mb-1" id="userProfileModalLabel">
                                    {{ $user->name }}
                                </h5>

                                <div class="text-muted small d-flex flex-wrap gap-3">
                                    <span>
                                        <i class="bi bi-geo-alt"></i>
                                        {{ $user->profile->address }}
                                    </span>
                                </div>
                            </div>

                        </div>

                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>

                    </div>

                    <div class="modal-body bg-light p-4">

                        <div class="row g-4">

                            <div class="col-md-7">

                                <div class="bg-white border rounded-4 p-4">

                                    <h6 class="fw-semibold mb-4">
                                        User Details
                                    </h6>

                                    <div class="row g-3">

                                        <div class="col-sm-6">
                                            <small class="text-muted d-block">
                                                Full Name
                                            </small>

                                            <div class="fw-medium">
                                                {{ $user->name }}
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <small class="text-muted d-block">
                                                Phone Number
                                            </small>

                                            <div class="fw-medium">
                                                {{ $user->profile->phone }}
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <small class="text-muted d-block">
                                                Member Since
                                            </small>

                                            <div class="fw-medium">
                                                {{ \Carbon\Carbon::parse($user->created_at)->format('F Y') }}
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <small class="text-muted d-block">
                                                Address
                                            </small>

                                            <div class="fw-medium">
                                                {{ $user->profile->address }}
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-5">

                                <div class="bg-white border rounded-4 p-4 mb-4">

                                    <h6 class="fw-semibold mb-4">
                                        Statistics
                                    </h6>

                                    <div class="d-flex justify-content-between mb-3">
                                        <span class="text-muted">
                                            Total Spent
                                        </span>

                                        <span class="fw-semibold">
                                            NPR 24,500
                                        </span>
                                    </div>

                                    <div class="d-flex justify-content-between mb-3">
                                        <span class="text-muted">
                                            Donations
                                        </span>

                                        <span class="fw-semibold text-success">
                                            NPR 8,750
                                        </span>
                                    </div>

                                    <div class="d-flex justify-content-between mb-3">
                                        <span class="text-muted">
                                            Completed Orders
                                        </span>

                                        <span class="fw-semibold">
                                            39
                                        </span>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="modal-footer bg-white border-top px-4 py-3">
                        <button class="btn border btn-light" data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
@endsection
