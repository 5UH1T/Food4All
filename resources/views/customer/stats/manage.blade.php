@extends('layouts.customer')
@section('customer_title')
    Stats - Customer
@endsection
@section('customer_content')
    <div class="">
        <div class="container-fluid p-0">

            <h2 class="text-center mb-5">Your Statistics</h2>

            <div class="row">
                <div class="col-xl-8 d-flex">
                    <div class="w-100">
                        <div class="row">

                            {{-- Products --}}
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="card-title">Items Purchased</h5>
                                            <span class="stat text-primary" style="width: 40px; height: 40px;">
                                                <i class="fas fa-utensils"></i>
                                            </span>
                                        </div>
                                        <h2 class="mt-1 mb-3">{{ $stats['products'] }}</h2>
                                    </div>
                                </div>
                            </div>

                            {{-- Stores --}}
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="card-title">Stores Explored</h5>
                                            <span class="stat text-primary" style="width: 40px; height: 40px;">
                                                <i class="fa-solid fa-shop"></i>
                                            </span>
                                        </div>
                                        <h2 class="mt-1 mb-3">{{ $stats['stores'] }}</h2>
                                    </div>
                                </div>
                            </div>

                            {{-- Order --}}
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="card-title">Successful Orders</h5>
                                            <span class="stat text-primary" style="width: 40px; height: 40px;">
                                                <i class="fa-solid fa-basket-shopping"></i>
                                            </span>
                                        </div>
                                        <h2 class="mt-1 mb-3">{{ $stats['orders'] || '0' }}</h2>
                                        <div class="mb-0">
                                            <small class="text-success">
                                                +{{ $analysis['orders'] }}
                                            </small>
                                            <small class="text-muted">this month</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Ordered Amount --}}
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="card-title">Ordered Amount</h5>
                                            <span class="stat text-primary" style="width: 40px; height: 40px;">
                                                <i class="fa-solid fa-dollar-sign"></i>
                                            </span>
                                        </div>
                                        <h2 class="mt-1 mb-3">Rs {{ $stats['order_amount'] }}</h2>
                                        <div class="mb-0">
                                            @if ($analysis['amount'])
                                                <small
                                                    class="{{ $analysis['amount'] > 0 ? 'text-success' : 'text-danger' }}">
                                                    {{ round($analysis['amount'], 2) }}%
                                                    <small class="text-muted">than last month</small>
                                                </small>
                                            @else
                                                <small class="text-success">New</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Donated Amount --}}
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="card-title">Donated Amount</h5>
                                            <span class="stat text-primary" style="width: 40px; height: 40px;">
                                                <i class="fa-solid fa-gift"></i>
                                            </span>
                                        </div>
                                        <h2 class="mt-1 mb-3">Rs. {{ $stats['donation'] }}</h2>
                                        <div class="mb-0">
                                            @if ($analysis['donation'])
                                                <small
                                                    class="{{ $analysis['donation'] > 0 ? 'text-success' : 'text-danger' }}">
                                                    {{ round($analysis['donation'], 2) }}%
                                                    <small class="text-muted">than last month</small>
                                                </small>
                                            @else
                                                <small class="text-success">New</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4">
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

        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", () => {
            flatpickr("#datetimepicker-dashboard", {
                inline: true,
                defaultDate: new Date()
            });
        });
    </script>
@endsection
