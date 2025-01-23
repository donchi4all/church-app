@extends('frontend.layouts.app')

@section('title', 'Ministries')

@section('content')

    <!-- Hero Section -->
    <x-hero-section :title="$hero['title']" :subtitle="$hero['subtitle']" :image="$hero['image']" :button="[
        'text' => $hero['button_text'],
        'link' => $hero['button_link'],
    ]" :youtube="$hero['youtube']"
        :image2="$hero['image2']" />


    <!-- Partnership Page -->
    <div class="container py-5" id="partnership-section">
        <div class="row mb-5 justify-content-center">
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="0">
                <div class="heading-wrap text-center">
                    <h2 class="heading">Partnership Form</h2>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8 mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="100">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('partnership.store') }}" method="POST"
                    class="contact-form bg-white p-4 rounded shadow">
                    @csrf
                    <!-- Title -->
                    <div class="mb-3">
                        <label class="text-black" for="title">Title</label>
                        <select class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                            required>
                            <option value="">Select Title</option>
                            <option value="Mr" {{ old('title') == 'Mr' ? 'selected' : '' }}>Mr</option>
                            <option value="Mrs" {{ old('title') == 'Mrs' ? 'selected' : '' }}>Mrs</option>
                            <option value="Miss" {{ old('title') == 'Miss' ? 'selected' : '' }}>Miss</option>
                            <option value="Dr" {{ old('title') == 'Dr' ? 'selected' : '' }}>Dr</option>
                            <option value="Prof" {{ old('title') == 'Prof' ? 'selected' : '' }}>Prof</option>
                        </select>
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- First Name, Middle Name, Last Name -->
                    <div class="row gy-3">
                        <div class="col-md-4 col-12">
                            <div class="mb-3">
                                <label class="text-black" for="first_name">First Name</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                    id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                                @error('first_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="mb-3">
                                <label class="text-black" for="middle_name">Middle Name</label>
                                <input type="text" class="form-control @error('middle_name') is-invalid @enderror"
                                    id="middle_name" name="middle_name" value="{{ old('middle_name') }}">
                                @error('middle_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="mb-3">
                                <label class="text-black" for="last_name">Last Name/Surname</label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                    id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                                @error('last_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Occupation -->
                    <div class="mb-3">
                        <label class="text-black" for="occupation">Occupation</label>
                        <input type="text" class="form-control @error('occupation') is-invalid @enderror" id="occupation"
                            name="occupation" value="{{ old('occupation') }}" required>
                        @error('occupation')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div class="mb-3">
                        <label class="text-black" for="address">Address</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="2"
                            required>{{ old('address') }}</textarea>
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- State/Country and Phone Number -->
                    <div class="row gy-3">
                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label class="text-black" for="state_country">State/Country</label>
                                <input type="text" class="form-control @error('state_country') is-invalid @enderror"
                                    id="state_country" name="state_country" value="{{ old('state_country') }}" required>
                                @error('state_country')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label class="text-black" for="phone_number">Phone Number</label>
                                <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                    id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required>
                                @error('phone_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Alternative Phone Number and Email -->
                    <div class="row gy-3">
                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label class="text-black" for="alt_phone_number">Alternative Phone Number</label>
                                <input type="text" class="form-control @error('alt_phone_number') is-invalid @enderror"
                                    id="alt_phone_number" name="alt_phone_number" value="{{ old('alt_phone_number') }}">
                                @error('alt_phone_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <label class="text-black" for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Monthly Pledge -->
                    <div class="mb-3">
                        <label class="text-black" for="monthly_pledge">Monthly Pledge</label>
                        <input type="number" class="form-control @error('monthly_pledge') is-invalid @enderror"
                            id="monthly_pledge" name="monthly_pledge" step="0.01"
                            value="{{ old('monthly_pledge') }}" required>
                        @error('monthly_pledge')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" class="btn btn-primary">Submit Partnership Form</button>
                    </div>
                </form>

                <!-- Styled Donation Link -->
                <div class="text-center mt-4">
                    <a href="{{ route('donation') }}" class="btn btn-danger btn-sm">
                        <i class="icon-heart-o me-2"></i> Make a Donation Today!
                    </a>
                    <p class="mt-2 text-muted">Your support makes a difference. Thank you!</p>
                </div>
            </div>
        </div>
    </div>




@endsection
