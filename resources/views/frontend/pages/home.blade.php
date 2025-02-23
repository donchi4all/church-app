@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')

    <!-- Hero Section -->
    <x-hero-section :title="$hero['title']" :subtitle="$hero['subtitle']" :image="$hero['image']" :button="[
        'text' => $hero['button_text'],
        'link' => $hero['button_link'],
    ]" :youtube="$hero['youtube']"
        :image2="$hero['image2']" />


    <!-- Upcoming Sermon Section -->
    <div class="section upcoming-sermon js-countdown py-5">
        <div class="container">
            <div class="row justify-content-between counter-wrap" id="clockdiv">
                <div class="col-lg-3 mb-4 mb-lg-0">
                    <img src="{{ asset($upcomingSermon['image']) }}" alt="Image" class="img-fluid rounded">
                </div>
                <div class="col-lg-8">
                    <span class="subheading d-block mb-4">Upcoming Sermons</span>
                    <h2 class="text-black">{{ $upcomingSermon['title'] }}</h2>
                    <p class="sermon-meta mb-4">By <strong>{{ $upcomingSermon['pastor'] }}</strong></p>

                    <div class="row">
                        <div class="col-6 col-sm-6 col-md-6 col-lg-3 text-left">
                            <div class="counter">
                                <span class="number d-block days" id="days"></span>
                                <span class="caption">Days</span>
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-3 text-left">
                            <div class="counter">
                                <span class="number d-block hours" id="hours"></span>
                                <span class="caption">Hours</span>
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-3 text-left">
                            <div class="counter">
                                <span class="number d-block minutes" id="minutes"></span>
                                <span class="caption">Minutes</span>
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-3 text-left">
                            <div class="counter">
                                <span class="number d-block seconds" id="seconds"></span>
                                <span class="caption">Seconds</span>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-12">
                            <a href="{{ $upcomingSermon['button_link'] }}" class="btn btn-secondary">
                                {{ $upcomingSermon['button_text'] }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Recent Sermons Section -->
    <div class="section">
        <div class="container">
            <div class="row mb-4 text-center">
                <div class="col-lg-12" data-aos="fade-up">
                    <span class="subheading d-block mb-4">Sermons</span>
                    <h2 class="mb-4 heading">Recent Sermons</h2>
                </div>
            </div>
            <div class="row g-5">
                @foreach ($recentSermons as $sermon)
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="0">
                        <x-sermon-card :title="$sermon['title']" :date="$sermon['date']" :pastor="$sermon['pastor']" :image="$sermon['image']"
                            :description="$sermon['description']" :link="$sermon['link']" />
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- About Us Section -->
    <div class="section  bg-white">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-4" data-aos="fade-up">
                    <span class="subheading mb-4 d-block">About us</span>
                    <h2 class="mb-4 heading">{{ $aboutUs['title'] }}</h2>
                    <p>{{ $aboutUs['description'] }}</p>
                    <p class="mt-5"><a href="{{ $aboutUs['button_link'] }}" class="btn btn-primary">
                            {{ $aboutUs['button_text'] }}</a></p>
                </div>
                <div class="col-lg-7" data-aos="fade-up" data-aos-delay="100">
                    <!-- <img src="images/landscape-1.jpg" alt="Image" class="img-fluid rounded"> -->
                    <div class="row">
                        @foreach (json_decode($aboutUs->images) as $image)
                            <div class="col-6 col-sm-6 col-md-4 col-lg-4 mb-4">
                                <img src="{{ asset($image) }}" alt="Image" class="img-fluid rounded">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials Section -->
    <div class="section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-7 mx-auto text-center mb-5" data-aos="fade-up">
                    <span class="subheading mb-4 d-block">Testimonials</span>
                    <h2 class="mb-4 heading">Living Testimonies</h2>
                </div>

                <div id="testimonial-nav" class="controls testimonial-nav">
                    <span class="prev" data-controls="prev" tabindex="-1">Prev</span>
                    <span class="next" data-controls="next" tabindex="-1">Next</span>
                </div>
            </div>

        </div>

        <div class="testimonial-slide-center-wrap" data-aos="fade-up" data-aos-delay="100">
            <div class="testimonial-slide-center testimonial-center" id="testimonial-center">

                @foreach ($testimonials as $testimonial)
                    <div class="item">
                        <div class="testimonial-item">
                            <div class="testimonial-item-inner">
                                <h3 class="testimonial-heading">{{ $testimonial['title'] }}</h3>
                                <blockquote>
                                    {{ $testimonial['quote'] }}
                                </blockquote>
                                <div class="testimonial-author">
                                    <img src="{{ asset($testimonial['image']) }}" alt="Image" class="img-fluid">
                                    <strong class="d-block">{{ $testimonial['author'] }}</strong>
                                    <span>{{ $testimonial['role'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>


        </div>

    </div>


    <!-- Join us Section -->
    <div class="section sec-cta bg-secondary">
        <div class="container">
            <div class="row align-items-center" data-aos="fade-up">
                <div class="col-lg-9 text-center text-md-start mb-4 mb-md-0">
                    <h2 class="heading text-white">{{ $joinUs['title'] }}</h2>
                </div>
                <div class="col-lg-3 text-center text-md-end" data-aos="fade-up" data-aos-delay="100">
                    <a href="{{ $joinUs['button_link'] }}"
                        class="btn btn-primary py-3 px-5">{{ $joinUs['button_text'] }}</a>
                </div>

            </div>
        </div>
    </div>

@endsection


<script>
    // Ensure the date is passed in the correct ISO format
    var countdownDate = new Date("{{ \Carbon\Carbon::parse($upcomingSermon['date'])->format('Y-m-d\TH:i:s') }}")
        .getTime();

    var x = setInterval(function() {
        var now = new Date().getTime();
        var distance = countdownDate - now;

        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("days").innerHTML = days;
        document.getElementById("hours").innerHTML = hours;
        document.getElementById("minutes").innerHTML = minutes;
        document.getElementById("seconds").innerHTML = seconds;

        // If the countdown is finished, display a message
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("clockdiv").innerHTML = "The sermon has started!";
        }
    }, 1000);
</script>


{{-- <script>
    // Countdown Timer Script
    var countdownDate = new Date("{{ $upcomingSermon['date'] }}").getTime();

    var x = setInterval(function() {
        var now = new Date().getTime();
        var distance = countdownDate - now;

        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("days").innerHTML = days;
        document.getElementById("hours").innerHTML = hours;
        document.getElementById("minutes").innerHTML = minutes;
        document.getElementById("seconds").innerHTML = seconds;

        // If the countdown is finished, display a message
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("clockdiv").innerHTML = "The sermon has started!";
        }
    }, 1000);
</script> --}}
