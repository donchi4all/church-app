@extends('frontend.layouts.app')

@section('title', 'Contact Us')

@section('content')
    <!-- Hero Section -->
    <x-hero-section :title="$hero['title']" :subtitle="$hero['subtitle']" :image="$hero['image']" :button="[
        'text' => $hero['button_text'],
        'link' => $hero['button_link'],
    ]" :youtube="$hero['youtube']"
        :image2="$hero['image2']" />

    <!-- Send Message -->
    <div class="container py-5" id="contact-section">
        <div class="row mb-5">
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="0">
                <div class="heading-wrap">
                    <h2 class="heading">Get In Touch</h2>
                </div>


            </div>

        </div>

        <div class="row">
            <!-- Display Success or Error Messages -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="100">
                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="text-black" for="fname">First name</label>
                                <input type="text" class="form-control" id="fname" name="first_name" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="text-black" for="lname">Last name</label>
                                <input type="text" class="form-control" id="lname" name="last_name" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="text-black" for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label class="text-black" for="message">Message</label>
                        <textarea class="form-control" id="message" name="message" cols="30" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>

            </div>
            <div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="200">
                <div class="quick-contact-item d-flex align-items-center mb-4">
                    <span class="icon-home"></span>
                    <address class="text">
                        {{ $contactDetails['address'] }}
                    </address>
                </div>
                <div class="quick-contact-item d-flex align-items-center mb-4">
                    <span class="icon-phone"></span>
                    <address class="text">
                        {{ $contactDetails['phone'] }}
                    </address>
                </div>
                <div class="quick-contact-item d-flex align-items-center mb-4">
                    <span class="icon-envelope"></span>
                    <address class="text">
                        {{ $contactDetails['email'] }}
                    </address>
                </div>
            </div>
        </div>
    </div>

    <!-- Map -->
    @isset($contactDetails['map'])
        <div id="map">
            <iframe src="{{ $contactDetails['map'] }}" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
                tabindex="0"></iframe>
        </div>
    @endisset

@endsection


<style>
    .alert {
        margin-bottom: 20px;
        padding: 10px 15px;
        border-radius: 4px;
        font-size: 14px;
    }

    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
    }

    .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
    }
</style>
