@extends('layouts.vendor')
@section('vendor_title')
    Donations - Vendor
@endsection
@section('vendor_content')
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

            <select name="filterDate" onchange="this.form.submit()"
                class="form-control w-100 pr-[40px] rounded-lg appearance-none cursor-pointer">
                <option value="" selected disabled>-- Filter By Date --</option>
                <option value="">All Donations</option>
                <option value="today" {{ request('filterDate') == 'today' ? 'selected' : '' }}>Today</option>
                <option value="week" {{ request('filterDate') == 'week' ? 'selected' : '' }}>This Week</option>
                <option value="month" {{ request('filterDate') == 'month' ? 'selected' : '' }}>This Month</option>
                <option value="year" {{ request('filterDate') == 'year' ? 'selected' : '' }}>This Year</option>
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
                        <th class="p-3">Donated Quantity</th>
                        <th class="p-3">Donated By</th>
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
                                    {{ $order->items->sum('donation_quantity') }}
                                </td>

                                <td class="p-3">
                                    {{ $order->user->name }}
                                </td>

                                <td class="p-3">
                                    {{ \Carbon\Carbon::parse($order->created_at)->format('F j, Y') }}
                                </td>


                                <td class="p-3 text-center">
                                    @php
                                        $status = $order->items->first()?->item_status;
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
                <div class="modal fade" id="viewOrderModal{{ $order->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content border-0 rounded-4">

                            <!-- Header -->
                            <div class="modal-header border-bottom">
                                <h5 class="modal-title fw-bold">
                                    Donation Details: Order #{{ $order->id }}
                                </h5>

                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">

                                <div class="row g-4">

                                    <div class="border rounded-3 overflow-auto" style="max-height: 100%">

                                        <table class="table table-hover align-middle mb-0">

                                            <thead class="table-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Product</th>
                                                    <th>Rate</th>
                                                    <th>Donated Qty</th>
                                                    <th>Total Qty</th>
                                                    <th>Sub Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->items as $index => $item)
                                                    @if ($item->donation_quantity > 0)
                                                        <tr>
                                                            <td>{{ 1 + $index }}</td>
                                                            <td>
                                                                <div class="d-flex align-items-center gap-3">
                                                                    <img src="{{ $item->product->productImage->first()->image_path }}"
                                                                        class="rounded w-[50px] h-[60px] object-cover">

                                                                    <div>
                                                                        <div class="fw-semibold">
                                                                            {{ $item->product->title }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                {{ number_format($item->total_price / $item->quantity, 2) }}
                                                            </td>
                                                            <td class="fw-semibold">{{ $item->donation_quantity }}</td>
                                                            <td>{{ $item->quantity }}</td>
                                                            <td class="fw-semibold">
                                                                Rs. {{ $item->total_price }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach

                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-light" data-bs-dismiss="modal">
                                    Close
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @endif

@endsection
