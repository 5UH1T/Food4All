@extends('layouts.admin')
@section('admin_title')
    Orders - Admin
@endsection
@section('admin_content')
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
                                            'text-red-600 bg-red-100' => $status === 'cancelled',
                                            'text-blue-600 bg-blue-100' => $status === 'confirmed',
                                            'text-amber-600 bg-amber-100' => $status === 'prepared',
                                            'text-purple-600 bg-purple-100' => $status === 'ready',
                                            'text-indigo-600 bg-indigo-100' => $status === 'picked',
                                            'text-green-600 bg-green-100' => $status === 'delivered',
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

    <!-- View Order Modal -->
    @if ($orders && $orders->count() > 0)
        @foreach ($orders as $index => $order)
            @if ($order->status !== 'cancelled')
                <div class="modal fade" id="viewOrderModal{{ $order->id }}" tabindex="-1"
                    aria-labelledby="viewOrderLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content rounded-3xl overflow-hidden border-0">

                            <!-- HEADER -->
                            <div class="modal-header bg-gray-900 text-white">
                                <div>
                                    <h5 class="modal-title font-bold" id="viewOrderLabel">
                                        Order Details - #{{ $order->id }}
                                    </h5>
                                    <small class="text-gray-300">
                                        Placed on:
                                        {{ \Carbon\Carbon::parse($order->created_at)->format('F j, Y') }}</small>
                                </div>

                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- BODY -->
                            <div class="modal-body bg-gray-50 p-4">

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                                    <!-- CUSTOMER INFO -->
                                    <div class="bg-white p-4 rounded-xl shadow-sm border">
                                        <h6 class="font-bold text-slate-900 mb-3">Customer Info</h6>
                                        <p class="text-slate-700"><span class="font-semibold">Name:</span>
                                            {{ $order->user->name }}</p>
                                        <p class="text-slate-700"><span class="font-semibold">Phone:</span>
                                            {{ $order->user->profile->phone }}
                                        </p>
                                        <p class="text-slate-700"><span class="font-semibold">Address:</span>
                                            {{ $order->user->profile->address }}
                                        </p>
                                    </div>

                                    <!-- ORDER INFO -->
                                    <div class="bg-white p-4 rounded-xl shadow-sm border">
                                        <h6 class="font-bold text-slate-900 mb-3">Order Info</h6>

                                        <p class="text-slate-700">
                                            <span class="font-semibold">Order ID:</span>
                                            #{{ $order->id }}
                                        </p>

                                        <p class="text-slate-700">
                                            <span class="font-semibold">Status:</span>
                                            <span @class([
                                                'px-3 py-1 rounded-full text-xs fw-semibold dropdown-toggle',
                                                'text-red-600 bg-red-100' => $order->status === 'cancelled',
                                                'text-blue-600 bg-blue-100' => $order->status === 'confirmed',
                                                'text-amber-600 bg-amber-100' => $order->status === 'prepared',
                                                'text-purple-600 bg-purple-100' => $order->status === 'ready',
                                                'text-indigo-600 bg-indigo-100' => $order->status === 'picked',
                                                'text-green-600 bg-green-100' => $order->status === 'delivered',
                                            ])>
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </p>

                                        <p class="text-slate-700">
                                            <span class="font-semibold">Payment:</span> Cash on Delivery
                                        </p>
                                    </div>

                                    <!-- SUMMARY -->
                                    <div class="bg-white p-4 rounded-xl shadow-sm border">
                                        <h6 class="font-semibold text-slate-900 mb-3">Summary</h6>
                                        <p class="text-slate-700"><span class="font-semibold">Total Quantity:</span>
                                            {{ $order->items->sum('quantity') }}
                                        </p>
                                        <p class="text-slate-700"><span class="font-semibold">Donated Quantity:</span>
                                            {{ $order->items->sum('donation_quantity') }}
                                        </p>
                                        <p class="text-slate-700 text-lg mt-2">
                                            <span class="font-semibold">Total:</span>
                                            <span class="text-green-600 font-bold">NPR {{ $order->total_cost }}</span>
                                        </p>
                                    </div>

                                </div>

                                <!-- ITEMS TABLE -->
                                <div class="mt-5 bg-white rounded-xl border shadow-sm overflow-hidden">
                                    <div class="p-3 border-b bg-gray-100 font-semibold text-slate-900">
                                        Ordered Items
                                    </div>

                                    <div class="overflow-x-auto">
                                        <table class="table table-hover align-middle mb-0">

                                            <thead class="table-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Product Name</th>
                                                    <th>Image</th>
                                                    <th>Seller</th>
                                                    <th>Rate</th>
                                                    <th>Total Qty</th>
                                                    <th>Donated Qty</th>
                                                    <th>Sub Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $grand_total = 0;
                                                @endphp
                                                @foreach ($order->items as $index => $item)
                                                    @php($grand_total += $item->total_price)
                                                    <tr>
                                                        <td>{{ 1 + $index }}</td>

                                                        <td class="fw-semibold">
                                                            {{ $item->product->title }}
                                                        </td>

                                                        <td>
                                                            <img src="{{ $item->product->productImage->first()->image_path }}"
                                                                class="rounded w-[50px] h-[60px] object-cover">
                                                        </td>

                                                        <td>{{ $item->product->vendor->name }}</td>

                                                        <td>
                                                            {{ number_format($item->total_price / $item->quantity, 2) }}
                                                        </td>
                                                        <td class="fw-semibold">
                                                            {{ $item->quantity - $item->donation_quantity }}</td>
                                                        <td>{{ $item->donation_quantity }}</td>
                                                        <td class="fw-semibold">
                                                            Rs. {{ $item->total_price }}
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>

                                            <tfoot class="table-light bg-red-500">
                                                <tr>
                                                    <th colspan="7" class="text-end">
                                                        Grand Total
                                                    </th>
                                                    <th class="text-success">
                                                        Rs. {{ number_format($grand_total, 2) }}
                                                    </th>
                                                </tr>
                                            </tfoot>

                                        </table>
                                    </div>
                                </div>


                            </div>

                            <!-- FOOTER -->
                            <div class="modal-footer bg-gray-100 flex justify-between">
                                <button class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @endif

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
