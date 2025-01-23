@extends('backend.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold">Dashboard</h4>

        <!-- Statistics -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Donations</h5>
                        <h3>{{ $stats['donations'] }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Partnerships</h5>
                        <h3>{{ $stats['partnerships'] }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Prayer Requests</h5>
                        <h3>{{ $stats['prayer_requests'] }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Testimonials</h5>
                        <h3>{{ $stats['testimonials'] }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">Monthly Donations</div>
                    <div class="card-body">
                        <div id="donationsChart"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">Top Partnership Locations</div>
                    <div class="card-body">
                        <div id="partnershipChart"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Example -->
        <div class="card mt-4">
            <div class="card-header">Recent Donations</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Donor Name</th>
                            <th>Payment Method</th>
                            <th>Currency</th>
                            <th>Month</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($monthlyDonations as $donation)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $donation->donor_name }}</td>
                                <td>{{ $donation->payment_method }}</td>
                                <td>{{ $donation->currency }}</td>
                                <td>{{ $donation->month }}</td>
                                <td>{{ number_format($donation->total, 2) }}</td>
                                <td>
                                    <span
                                        class="badge bg-label-{{ $donation->status == 'success' ? 'success' : ($donation->status == 'failed' ? 'danger' : 'warning') }} me-1">
                                        {{ ucfirst($donation->status) }}
                                    </span>
                                </td>
                                <td>{{ now()->month($donation->month)->format('F Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        // Monthly Donations Chart
        var options = {
            chart: {
                type: 'line'
            },
            series: [{
                name: 'Total Donations',
                data: @json($monthlyDonations->pluck('total'))
            }],
            xaxis: {
                categories: @json($monthlyDonations->pluck('month'))
            }
        };
        var chart = new ApexCharts(document.querySelector("#donationsChart"), options);
        chart.render();

        // Partnership Chart
        var options2 = {
            chart: {
                type: 'pie'
            },
            series: @json($partnershipStats->pluck('total')),
            labels: @json($partnershipStats->pluck('state_country'))
        };
        var chart2 = new ApexCharts(document.querySelector("#partnershipChart"), options2);
        chart2.render();
    </script>
@endsection
