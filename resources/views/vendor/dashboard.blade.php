@extends('layouts.vendor')
@section('vendor_title')
    Dashboard - Vendor
@endsection
@section('vendor_content')
    <!-- STATS -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <p class="text-sm text-gray-500">Users</p>

            <h2 class="text-3xl font-bold mt-2 text-gray-800">
                12,540
            </h2>

            <span class="text-green-500 text-sm font-medium">
                +14%
            </span>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <p class="text-sm text-gray-500">Revenue</p>

            <h2 class="text-3xl font-bold mt-2 text-gray-800">
                $48,200
            </h2>

            <span class="text-green-500 text-sm font-medium">
                +9%
            </span>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <p class="text-sm text-gray-500">Orders</p>

            <h2 class="text-3xl font-bold mt-2 text-gray-800">
                1,245
            </h2>

            <span class="text-red-500 text-sm font-medium">
                -2%
            </span>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <p class="text-sm text-gray-500">Conversion</p>

            <h2 class="text-3xl font-bold mt-2 text-gray-800">
                18.4%
            </h2>

            <span class="text-green-500 text-sm font-medium">
                +4%
            </span>
        </div>

    </div>


    <!-- CHART GRID -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-6">

        <!-- AREA CHART -->
        <div class="xl:col-span-2 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">

            <div class="mb-5">
                <h2 class="text-lg font-bold text-gray-800">
                    Revenue Analytics
                </h2>

                <p class="text-sm text-gray-500">
                    Monthly revenue overview
                </p>
            </div>

            <div id="revenueChart"></div>
        </div>


        <!-- DONUT -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">

            <div class="mb-5">
                <h2 class="text-lg font-bold text-gray-800">
                    Traffic Sources
                </h2>

                <p class="text-sm text-gray-500">
                    Visitors breakdown
                </p>
            </div>

            <div id="trafficChart"></div>
        </div>

    </div>


    <!-- SECOND ROW -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-6">

        <!-- BAR CHART -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">

            <div class="mb-5">
                <h2 class="text-lg font-bold text-gray-800">
                    Sales Comparison
                </h2>

                <p class="text-sm text-gray-500">
                    Current vs previous year
                </p>
            </div>

            <div id="barChart"></div>
        </div>


        <!-- RADIAL -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">

            <div class="mb-5">
                <h2 class="text-lg font-bold text-gray-800">
                    Server Usage
                </h2>

                <p class="text-sm text-gray-500">
                    Current performance
                </p>
            </div>

            <div id="radialChart"></div>
        </div>

    </div>


    <!-- TABLE -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        <div class="p-6 border-b border-gray-100">

            <h2 class="text-lg font-bold text-gray-800">
                Recent Orders
            </h2>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-left">

                <!-- HEAD -->
                <thead class="bg-gray-50 border-b border-gray-100">

                    <tr>

                        <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                            Order ID
                        </th>

                        <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                            Customer
                        </th>

                        <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                            Amount
                        </th>

                        <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                            Status
                        </th>

                        <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                            Date
                        </th>

                        <th class="px-6 py-4 text-sm font-semibold text-gray-600 text-right">
                            Actions
                        </th>

                    </tr>

                </thead>

                <!-- BODY -->
                <tbody>

                    <!-- ROW -->
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition">

                        <td class="px-6 py-4 font-semibold text-gray-700">
                            #1024
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            John Doe
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            $420
                        </td>

                        <td class="px-6 py-4">

                            <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-semibold">
                                Completed
                            </span>

                        </td>

                        <td class="px-6 py-4 text-gray-500">
                            12 May 2026
                        </td>

                        <!-- ACTIONS -->
                        <td class="px-6 py-4">

                            <div class="flex items-center justify-end gap-3">

                                <!-- EDIT -->
                                <button
                                    class="w-9 h-9 flex items-center justify-center rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>

                                </button>


                                <!-- DELETE -->
                                <button
                                    class="w-9 h-9 flex items-center justify-center rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h8" />
                                    </svg>

                                </button>

                            </div>

                        </td>

                    </tr>



                    <!-- ROW -->
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition">

                        <td class="px-6 py-4 font-semibold text-gray-700">
                            #1025
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            Sarah Smith
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            $220
                        </td>

                        <td class="px-6 py-4">

                            <span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-xs font-semibold">
                                Pending
                            </span>

                        </td>

                        <td class="px-6 py-4 text-gray-500">
                            12 May 2026
                        </td>

                        <td class="px-6 py-4">

                            <div class="flex items-center justify-end gap-3">

                                <!-- EDIT -->
                                <button
                                    class="w-9 h-9 flex items-center justify-center rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>

                                </button>


                                <!-- DELETE -->
                                <button
                                    class="w-9 h-9 flex items-center justify-center rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h8" />
                                    </svg>

                                </button>

                            </div>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>



    <!-- APEXCHARTS -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // AREA CHART
            new ApexCharts(document.querySelector("#revenueChart"), {
                chart: {
                    type: 'area',
                    height: 320,
                    toolbar: {
                        show: false
                    }
                },

                series: [{
                    name: 'Revenue',
                    data: [1200, 2100, 1800, 3200, 2800, 4100, 3900]
                }],

                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul']
                },

                colors: ['#2563eb'],

                stroke: {
                    curve: 'smooth',
                    width: 3
                },

                fill: {
                    type: 'gradient',
                    gradient: {
                        opacityFrom: 0.5,
                        opacityTo: 0.1
                    }
                },

                dataLabels: {
                    enabled: false
                }

            }).render();



            // DONUT CHART
            new ApexCharts(document.querySelector("#trafficChart"), {

                chart: {
                    type: 'donut',
                    height: 320
                },

                series: [44, 33, 23],

                labels: ['Social', 'Search', 'Direct'],

                colors: ['#2563eb', '#10b981', '#f59e0b'],

                legend: {
                    position: 'bottom'
                },

                dataLabels: {
                    enabled: false
                }

            }).render();



            // BAR CHART
            new ApexCharts(document.querySelector("#barChart"), {

                chart: {
                    type: 'bar',
                    height: 320,
                    toolbar: {
                        show: false
                    }
                },

                series: [{
                        name: '2025',
                        data: [30, 40, 35, 50, 49, 60]
                    },
                    {
                        name: '2026',
                        data: [45, 55, 50, 70, 60, 80]
                    }
                ],

                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
                },

                colors: ['#94a3b8', '#2563eb'],

                borderRadius: 6,

                dataLabels: {
                    enabled: false
                }

            }).render();



            // RADIAL CHART
            new ApexCharts(document.querySelector("#radialChart"), {

                chart: {
                    type: 'radialBar',
                    height: 320
                },

                series: [76],

                colors: ['#10b981'],

                plotOptions: {
                    radialBar: {
                        hollow: {
                            size: '65%'
                        },

                        dataLabels: {
                            value: {
                                fontSize: '32px',
                                fontWeight: 700
                            }
                        }
                    }
                },

                labels: ['Usage']

            }).render();

        });
    </script>
@endsection
