<div class="hero overlay" style="background-image: url('{{ asset($image) }}');">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center text-lg-start">
            <!-- Text Content -->
            <div class="col-lg-6 col-md-8">
                <div class="intro-text">
                    <!-- ✅ Improved heading size & max-width -->
                    <h1 class="hero-heading" data-aos="fade-left">{{ $title }}</h1>

                    @isset($subtitle)
                        <p class="subtitle-text opacity-7 small" data-aos="fade-left" data-aos-delay="200">
                            {{ $subtitle }}
                        </p>
                        @isset($button)
                            <a href="{{ $button['link'] }}" class="btn btn-primary mt-3" data-aos="fade-left"
                                data-aos-delay="300">
                                {{ $button['text'] }}
                            </a>
                        @endisset
                    @endisset
                </div>
            </div>

            <!-- YouTube or Image Content -->
            @isset($youtube)
                <div class="col-lg-6 col-md-5 col-sm-12 mt-4 mt-md-0" data-aos="fade-left">
                    <a href="{{ $youtube }}" class="video-bg glightbox position-relative d-block">
                        <span class="icon d-flex align-items-center justify-content-center">
                            <span class="icon-play"></span>
                        </span>
                        @isset($image2)
                            <img src="{{ asset($image2) }}" alt="Image" class="img-fluid rounded shadow">
                        @endisset
                    </a>
                </div>
            @endisset
        </div>
    </div>
</div>

<!-- ✅ Final CSS Fixes -->
<style>
    .hero {
        position: relative;
        background-size: cover;
        background-position: center;
        padding: 4rem 1rem;
        color: white;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.6);
    }

    /* ✅ Adjusted font size and width */
    .hero .hero-heading {
        font-size: 2.5rem;
        line-height: 1.2;
        word-break: normal;
        text-align: center;
        /* Default center for mobile */
        max-width: 80%;
        /* Prevents too much width */
        margin: 0 auto;
    }

    .hero .subtitle-text {
        font-size: 1rem;
        opacity: 0.9;
        text-align: center;
        max-width: 75%;
        margin: 0 auto;
    }

    /* ✅ Desktop adjustments */
    @media (min-width: 992px) {
        .hero .hero-heading {
            font-size: 3rem;
            /* Slightly bigger on larger screens */
            text-align: left;
            max-width: 100%;
        }

        .hero .subtitle-text {
            text-align: left;
            max-width: 100%;
        }
    }

    /* ✅ Mobile and Tablet fixes */
    @media (max-width: 768px) {
        .hero .hero-heading {
            font-size: 2rem;
            max-width: 90%;
            margin-top: 2rem;
            /* ✅ Moves it down */
        }

        .hero .subtitle-text {
            font-size: 0.9rem;
        }

        .hero {
            padding-top: 6rem;
            /* ✅ Adds extra spacing only on mobile */
        }
    }

    @media (max-width: 576px) {
        .hero .hero-heading {
            font-size: 1.75rem;
        }

        .hero .subtitle-text {
            font-size: 0.8rem;
        }
    }
</style>
