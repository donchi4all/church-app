@extends('frontend.layouts.app')
@section('title', 'Contact Us')

@section('content')
    <!-- Hero Section -->
    <x-hero-section :title="$hero['title']" :subtitle="$hero['subtitle']" :image="$hero['image']" :button="[
        'text' => $hero['button_text'],
        'link' => $hero['button_link'],
    ]" :youtube="$hero['youtube']"
        :image2="$hero['image2']" />

    <div class="container py-5" id="donation-section">
        <div class="row mb-5 justify-content-center">
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="0">
                <div class="heading-wrap text-center">
                    <h2 class="heading">Donation</h2>
                    <p>Support our ministry through the donation method of your choice.</p>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
            </div>
        </div>

        <!-- Tabs for International and Local Payments -->
        <ul class="nav nav-tabs mb-4 justify-content-center" id="donationTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="international-tab" data-bs-toggle="tab" href="#international" role="tab"
                    aria-controls="international" aria-selected="true">International Payments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="local-tab" data-bs-toggle="tab" href="#local" role="tab" aria-controls="local"
                    aria-selected="false">Local Payments</a>
            </li>
        </ul>

        <div class="tab-content" id="donationTabContent">
            <!-- International Payments Tab -->
            <div class="tab-pane fade show active" id="international" role="tabpanel" aria-labelledby="international-tab">
                <ul class="nav nav-pills mb-4 justify-content-center" id="internationalTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="paystack-tab" data-bs-toggle="tab" href="#paystack" role="tab"
                            aria-controls="paystack" aria-selected="true">Paystack</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="paypal-tab" data-bs-toggle="tab" href="#paypal" role="tab"
                            aria-controls="paypal" aria-selected="false">PayPal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="bank_donations-tab" data-bs-toggle="tab" href="#bank_donations"
                            role="tab" aria-controls="bank_donations" aria-selected="false">Bank Donation</a>
                    </li>
                </ul>

                <div class="tab-content" id="internationalTabContent">
                    <!-- Paystack Form -->
                    <div class="tab-pane fade show active" id="paystack" role="tabpanel" aria-labelledby="paystack-tab">
                        <div class="border p-4 rounded bg-white mx-auto" style="max-width: 500px;">
                            <h4 class="text-center">Pay with Paystack</h4>
                            <form method="POST" action="{{ route('donate.paystack') }}">
                                @csrf
                                <div class="mb-3">
                                    <label class="text-black" for="paystack_first_name">First Name</label>
                                    <input type="text" class="form-control" id="paystack_first_name" name="first_name"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label class="text-black" for="paystack_last_name">Last Name</label>
                                    <input type="text" class="form-control" id="paystack_last_name" name="last_name"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label class="text-black" for="paystack_email">Email</label>
                                    <input type="email" class="form-control" id="paystack_email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label class="text-black" for="paystack_phone">Phone Number</label>
                                    <input type="tel" class="form-control" id="paystack_phone" name="phone"
                                        pattern="^\+?[0-9]{10,15}$" required>
                                </div>
                                <div class="mb-3">
                                    <label class="text-black" for="paystack_amount">Amount (₦)</label>
                                    <input type="number" class="form-control" id="paystack_amount" name="amount"
                                        step="0.01" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Pay with Paystack</button>
                            </form>
                        </div>
                    </div>

                    <!-- PayPal Form -->
                    <div class="tab-pane fade" id="paypal" role="tabpanel" aria-labelledby="paypal-tab">
                        <div class="border p-4 rounded bg-white mx-auto" style="max-width: 500px;">
                            <h4 class="text-center">Donate with PayPal</h4>
                            <form method="POST" action="{{ route('donate.paypal') }}">
                                @csrf
                                <div class="mb-3">
                                    <label class="text-black" for="paypal_first_name">First Name</label>
                                    <input type="text" class="form-control" id="paypal_first_name" name="first_name"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label class="text-black" for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label class="text-black" for="phone">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" name="phone"
                                        pattern="^\+?[0-9]{10,15}$" required>
                                </div>
                                <div class="mb-3">
                                    <label class="text-black" for="paypal_amount">Amount (USD)</label>
                                    <input type="number" class="form-control" id="paypal_amount" name="amount"
                                        step="0.01" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Donate with PayPal</button>
                            </form>
                        </div>
                    </div>

                    <!-- Bank Donation -->
                    <div class="tab-pane fade" id="bank_donations" role="tabpanel" aria-labelledby="bank_donations-tab">
                        <div class="border p-4 rounded bg-white mx-auto" style="max-width: 500px;">
                            <h4 class="text-center">Bank Donations</h4>
                            <p class="text-center">Please use the following bank details to make your donations:</p>
                            <ul class="list-unstyled">
                                <li><strong>Access Bank</strong>: <br> Account Name - Grace Operated Life Ministry<br>
                                    Account
                                    Number - 1234567890</li>
                                <li class="mt-3"><strong>UBA</strong>: <br> Account Name - Grace Operated Life
                                    Ministry<br>
                                    Account Number - 0987654321</li>
                                <li class="mt-3"><strong>Zenith Bank</strong>: <br> Account Name - Grace Operated Life
                                    Ministry<br> Account Number - 1122334455</li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Local Payments Tab -->
            <div class="tab-pane fade" id="local" role="tabpanel" aria-labelledby="local-tab">
                <div class="border p-4 rounded bg-white mx-auto" style="max-width: 500px;">
                    <h4 class="text-center">Bank Donations</h4>
                    <p class="text-center">Please use the following bank details to make your donations:</p>
                    <ul class="list-unstyled">
                        <li><strong>Access Bank</strong>: <br> Account Name - Grace Operated Life Ministry<br> Account
                            Number - 1234567890</li>
                        <li class="mt-3"><strong>UBA</strong>: <br> Account Name - Grace Operated Life Ministry<br>
                            Account Number - 0987654321</li>
                        <li class="mt-3"><strong>Zenith Bank</strong>: <br> Account Name - Grace Operated Life
                            Ministry<br> Account Number - 1122334455</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


@endsection

<style>
    /* .nav-tabs .nav-link.active {
        background-color: #007bff;
        color: white !important;
        border-color: #007bff;
    }

    .nav-tabs .nav-link {
        color: #007bff;
        border: 1px solid #007bff;
        margin-right: 5px;
        border-radius: 5px;
        padding: 10px 15px;
    }

    .tab-pane {
        margin-top: 20px;
    } */
</style>
