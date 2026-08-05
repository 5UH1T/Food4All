@extends('layouts.vendor')
@section('vendor_title')
    Dashboard - Vendor
@endsection
@section('vendor_content')
    <div class="">
        <div class="container-fluid p-0">
            <h2 class="mb-5">Analytics Dashboard</h1>

                <div class="row">

                    {{-- Stat Cards --}}
                    <div class="col-xl-7 d-flex">
                        <div class="w-100">
                            <div class="row">
                                {{-- Total Orders --}}
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h5 class="card-title">Orders</h5>
                                                <span class="stat text-primary" style="width: 30px; height: 30px;">
                                                    <i class="fa-solid fa-basket-shopping"></i>
                                                </span>
                                            </div>
                                            <h2 class="mt-1 mb-3">{{ $stats['orders'] }}</h2>
                                            @if ($stats['salesF'])
                                                @if ($stats['salesF'] > 0)
                                                    <div class="mb-0">
                                                        <small class="text-success"> <i
                                                                class="mdi mdi-arrow-bottom-right"></i>
                                                            {{ $stats['salesF'] }}% </small>
                                                        <small class="text-muted">Since last month</small>
                                                    </div>
                                                @else
                                                    <div class="mb-0">
                                                        <small class="text-danger"> <i
                                                                class="mdi mdi-arrow-bottom-right"></i>
                                                            {{ $stats['salesF'] }}% </small>
                                                        <small class="text-muted">Since last month</small>
                                                    </div>
                                                @endif
                                            @else
                                                <small class="text-success">New</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- Total Revenue --}}
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h5 class="card-title">Total Revenue</h5>
                                                <span class="stat text-primary" style="width: 30px; height: 30px;">
                                                    <i class="fa-solid fa-dollar-sign"></i>
                                                </span>
                                            </div>
                                            <h2 class="mt-1 mb-3">Rs. {{ $stats['revenue'] }}</h2>
                                            @if ($stats['revenueF'])
                                                @if ($stats['revenueF'] > 0)
                                                    <div class="mb-0">
                                                        <small class="text-success"> <i
                                                                class="mdi mdi-arrow-bottom-right"></i>
                                                            {{ $stats['revenueF'] }}% </small>
                                                        <small class="text-muted">Since last month</small>
                                                    </div>
                                                @else
                                                    <div class="mb-0">
                                                        <small class="text-danger"> <i
                                                                class="mdi mdi-arrow-bottom-right"></i>
                                                            {{ $stats['revenueF'] }}% </small>
                                                        <small class="text-muted">Since last month</small>
                                                    </div>
                                                @endif
                                            @else
                                                <small class="text-success">New</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- Cutomers --}}
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h5 class="card-title">Customers</h5>
                                                <span class="stat text-primary" style="width: 30px; height: 30px;">
                                                    <i class="fas fa-users"></i>
                                                </span>
                                            </div>
                                            <h2 class="mt-1 mb-3">{{ $stats['customers'] }}</h2>
                                            <div class="mb-0">
                                                <small class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i>
                                                    +{{ $stats['uniqueUser'] }} </small>
                                                <small class="text-muted">Since last month</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Top Products --}}
                                <div class="">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h5 class="card-title">Top Selling Products</h5>
                                                <span class="stat text-primary" style="width: 30px; height: 30px;">
                                                    <i class="fas fa-utensils"></i>
                                                </span>
                                            </div>
                                            <table class="table mt-2 align-middle">
                                                @forelse($stats['top'] as $index => $item)
                                                    <tr>
                                                        <td class="p-1 fw-bold">{{ $loop->iteration }}</td>
                                                        <td class="p-1 fw-bold">{{ $item['product']->title }}</td>
                                                        <td class="p-1 fw-bold text-end">{{ $item['sales'] }} units
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <span>No Products Found</span>
                                                @endforelse
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- Monthly Revenue --}}
                    <div class="col-xl-5">
                        <div class="card flex-fill w-100">
                            <div class="card-header">

                                <h5 class="card-title mb-0">Monthly Revenue</h5>
                            </div>
                            <div class="card-body py-3">
                                <div class="chart chart-sm">
                                    <canvas id="chartjs-dashboard-line"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">

                    {{-- Order History --}}
                    <div class="col-12 col-md-6 col-xxl-4 d-flex">
                        <div class="card flex-fill w-100">
                            <div class="card-header">

                                <h5 class="card-title mb-0">Order History</h5>
                            </div>
                            <div class="card-body d-flex">
                                <div class="align-self-center w-100">
                                    <div class="py-3">
                                        <div class="chart chart-xs">
                                            <canvas id="chartjs-dashboard-pie"></canvas>
                                        </div>
                                    </div>

                                    <table class="table mb-0">
                                        <tbody>
                                            <tr>
                                                <td>Completed</td>
                                                <td class="text-end">{{ $stats['complete'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>Pending</td>
                                                <td class="text-end">{{ $stats['pending'] }}</td>
                                            </tr>
                                            <tr>
                                                <td>Cancelled</td>
                                                <td class="text-end">{{ $stats['cancel'] }}</td>
                                            </tr>
                                            <tr class="fw-bold">
                                                <td>Total</td>
                                                <td class="text-end">
                                                    {{ $stats['complete'] + $stats['pending'] + $stats['cancel'] }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Monthly Sales --}}
                    <div class="col-12 col-lg-4 col-xxl-4 d-flex">
                        <div class="card flex-fill w-100">
                            <div class="card-header">

                                <h5 class="card-title mb-0">Monthly Sales</h5>
                            </div>
                            <div class="card-body d-flex w-100">
                                <div class="align-self-center chart chart-lg">
                                    <canvas id="chartjs-dashboard-bar"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-xxl-4 d-flex">
                        <div class="card flex-fill">
                            <div class="card-header">

                                <h5 class="card-title mb-0">Calendar</h5>
                            </div>
                            <div class="card-body d-flex">
                                <div class="align-self-center w-100">
                                    <div class="chart">
                                        <div id="datetimepicker-dashboard"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class=" d-flex">
                        <div class="card flex-fill">
                            <div class="card-header">

                                <h5 class="card-title mb-0">Latest Orders</h5>
                            </div>
                            <table class="w-full text-left">

                                <thead class="bg-gray-50 border-b border-gray-100">
                                    <tr>
                                        <th class="p-3">S.N.</th>
                                        <th class="p-3">Order ID</th>
                                        <th class="p-3">Ordered By</th>
                                        <th class="p-3">Amount</th>
                                        <th class="p-3">Date</th>
                                        <th class="p-3 text-center">Status</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @if (!$allOrders || $allOrders->count() === 0)
                                        <tr>
                                            <td colspan="9" class="p-4 text-center fw-semibold">
                                                No Orders Found
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($allOrders as $index => $order)
                                            <tr class="border-b border-gray-100 hover:bg-gray-50">

                                                <td class="p-3">
                                                    {{ 1 + $index }}
                                                </td>

                                                <td class="p-3 font-bold">
                                                    #{{ $order->id }}
                                                </td>

                                                <td class="p-3">
                                                    {{ $order->user->name }}
                                                </td>

                                                <td class="p-3">
                                                    Rs. {{ $order->items->sum('total_price') }}
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
                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
            var gradient = ctx.createLinearGradient(0, 0, 0, 225);
            gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
            gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
            // Line chart
            new Chart(document.getElementById("chartjs-dashboard-line"), {
                type: "line",
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov",
                        "Dec"
                    ],
                    datasets: [{
                        label: "Sales (₹)",
                        fill: true,
                        backgroundColor: gradient,
                        borderColor: window.theme.primary,
                        // data: [
                        //     2115,
                        //     1562,
                        //     1584,
                        //     1892,
                        //     1587,
                        //     1923,
                        //     2566,
                        //     2448,
                        //     2805,
                        //     3438,
                        //     2917,
                        //     3327
                        // ]
                        data: {{ Js::from(array_values($chart_stats['revenue'])) }},
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    tooltips: {
                        intersect: false
                    },
                    hover: {
                        intersect: true
                    },
                    plugins: {
                        filler: {
                            propagate: false
                        }
                    },
                    scales: {
                        xAxes: [{
                            reverse: true,
                            gridLines: {
                                color: "rgba(0,0,0,0.0)"
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                stepSize: 5000
                            },
                            display: true,
                            borderDash: [3, 3],
                            gridLines: {
                                color: "rgba(0,0,0,0.0)"
                            }
                        }]
                    }
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Pie chart
            new Chart(document.getElementById("chartjs-dashboard-pie"), {
                type: "pie",
                data: {
                    labels: ["Completed", "Pending", "Cancelled"],
                    datasets: [{
                        data: [{{ $stats['complete'] }}, {{ $stats['pending'] }},
                            {{ $stats['cancel'] }}
                        ],
                        backgroundColor: [
                            window.theme.success,
                            window.theme.warning,
                            window.theme.danger
                        ],
                        borderWidth: 5
                    }]
                },
                options: {
                    responsive: !window.MSInputMethodContext,
                    maintainAspectRatio: false,
                    legend: {
                        display: true
                    },
                    cutoutPercentage: 50
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Bar chart
            new Chart(document.getElementById("chartjs-dashboard-bar"), {
                type: "bar",
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov",
                        "Dec"
                    ],
                    datasets: [{
                        label: "Units Sold",
                        backgroundColor: window.theme.primary,
                        borderColor: window.theme.primary,
                        hoverBackgroundColor: window.theme.light,
                        hoverBorderColor: window.theme.light,
                        data: {{ Js::from(array_values($chart_stats['units'])) }},
                        barPercentage: .75,
                        categoryPercentage: .5
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: false
                            },
                            stacked: false,
                            ticks: {
                                stepSize: 200
                            }
                        }],
                        xAxes: [{
                            stacked: false,
                            gridLines: {
                                color: "transparent"
                            }
                        }]
                    }
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            flatpickr("#datetimepicker-dashboard", {
                inline: true,
                defaultDate: new Date()
            });
        });
    </script>
@endsection
