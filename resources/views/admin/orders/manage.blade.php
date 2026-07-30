@extends('layouts.admin')
@section('admin_title')
    Orders - Admin
@endsection
@section('admin_content')
    @include('components.admin.orders.view-order')
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
    <div class="w-full flex flex-row-reverse items-center justify-between mb-10">
        <form method="GET" class="form-outline relative border-1 border-slate-500 rounded-lg overflow-hidden w-[300px]">
            <input type="search" name="search" required placeholder="Search by Order Number" value="{{ request('search') }}"
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

        <form method="GET" class="form-outline relative border-1 border-slate-500 rounded-lg overflow-hidden w-[220px]">
            {{-- Preserve search query --}}
            @if (request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
            @endif

            <select name="status" onchange="this.form.submit()"
                class="form-control w-100 pr-[40px] rounded-lg appearance-none cursor-pointer">
                <option value="" selected disabled>-- Filter By Status --</option>
                <option value="">All Orders</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="prepared" {{ request('status') == 'prepared' ? 'selected' : '' }}>Prepared</option>
                <option value="ready" {{ request('status') == 'ready' ? 'selected' : '' }}>Ready to Pickup</option>
                <option value="picked" {{ request('status') == 'picked' ? 'selected' : '' }}>Picked Up</option>
                <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
            </select>
        </form>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full text-left">

                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="p-3">S.N.</th>
                        <th class="p-3">Order ID</th>
                        <th class="p-3">Ordered By</th>
                        <th class="p-3">Amount</th>
                        <th class="p-3">Date</th>
                        <th class="p-3 text-center">Status</th>
                        <th class="p-3 text-end">Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @if (!$orders || $orders->count() === 0)
                        <tr>
                            <td colspan="9" class="p-4 text-center fw-semibold">
                                No Orders Found
                            </td>
                        </tr>
                    @else
                        @foreach ($orders as $index => $order)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">

                                <td class="p-3">
                                    {{ $orders->firstItem() + $index }}
                                </td>

                                <td class="p-3 font-bold">
                                    #{{ $order->id }}
                                </td>

                                <td class="p-3">
                                    {{ $order->user->name }}
                                </td>

                                <td class="p-3">
                                    {{-- Rs. {{ number_format($product->price, 2) }} --}}
                                    @php
                                        $total = 0;
                                        foreach ($order->items as $item) {
                                            $total += $item->total_price;
                                        }
                                    @endphp
                                    Rs. {{ $total }}
                                </td>

                                <td class="p-3">
                                    {{ \Carbon\Carbon::parse($order->created_at)->format('F j, Y') }}
                                </td>


                                <td class="p-3 text-center">
                                    @php
                                        $status = $order->status;
                                    @endphp
                                    <div class="dropdown flex items-center justify-center gap-2">
                                        <span @class([
                                            'px-3 py-1 rounded-full text-xs fw-semibold dropdown-toggle',
                                            'text-green-600 bg-green-100' => $status === 'confirmed',
                                            'text-red-600 bg-red-100' => $status === 'cancelled',
                                            'text-teal-600 bg-teal-100' => !in_array($status, [
                                                'confirmed',
                                                'cancelled',
                                            ]),
                                        ])>
                                            {{ $status === 'ready' ? 'Ready to Pickup' : ucfirst($status) }}
                                        </span>
                                        @if ($status === 'ready')
                                            <i class="fas fa-sort-down text-gray-500 mt-[-10px]" type="button"
                                                data-bs-toggle="dropdown"></i>

                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item update-status-btn"
                                                        data-id="{{ $order->id }}" data-bs-toggle="modal"
                                                        data-status="picked" data-bs-target="#updateStatusModal">
                                                        Mark as Picked Up
                                                    </a>
                                                </li>
                                            </ul>
                                        @elseif ($status === 'picked')
                                            <i class="fas fa-sort-down text-gray-500 mt-[-10px]" type="button"
                                                data-bs-toggle="dropdown"></i>

                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item update-status-btn"
                                                        data-id="{{ $order->id }}" data-bs-toggle="modal"
                                                        data-status="delivered" data-bs-target="#updateStatusModal">
                                                        Mark as Delivered
                                                    </a>
                                                </li>
                                            </ul>
                                        @endif
                                    </div>
                                </td>
                                <td class="p-3 text-end">
                                    <div class="flex justify-end gap-3">
                                        @if ($order->status !== 'cancelled')
                                            <button
                                                class="w-9 h-9 flex items-center justify-center rounded-lg bg-blue-50 text-blue-600"
                                                data-id="{{ $order->id }}" data-bs-toggle="modal"
                                                data-bs-target="#viewOrderModal{{ $order->id }}">
                                                <i class="fa-solid fa-eye"></i>

                                            </button>
                                        @else
                                            <button disabled
                                                class="w-9 h-9 flex items-center justify-center rounded-lg bg-red-50 text-red-600">
                                                -
                                            </button>
                                        @endif
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
        {{ $orders->links('pagination::bootstrap-5') }}
    </div>

    <!-- UPDATE STATUS MODAL -->
    <div class="modal fade" id="updateStatusModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-3">

                <!-- HEADER -->
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Update Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- BODY -->
                <div class="modal-body">
                    Are you sure you want to update this order status?
                </div>

                <!-- FOOTER -->
                <div class="modal-footer">

                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <form id="updateStatusForm" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" id="status">
                        <button type="submit" class="btn btn-success">
                            Update
                        </button>
                    </form>

                </div>

            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.update-status-btn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.dataset.id;
                const status = this.dataset.status;

                document.getElementById('status').value = status;

                document.getElementById('updateStatusForm').action = `/admin/orders/${id}/status`;
            });
        });
    </script>
@endsection
