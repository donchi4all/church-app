
<div class="hero overlay" style="background-image: url('{{ asset($image) }}'); ">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-5 me-auto text-start pe-lg-5">
                <div class="intro-text">
                    <div class="mb-4">
                        <h1 data-aos="fade-left" class="hero-heading">{{ $title }}</h1>
                    </div>
                    @isset($subtitle)
                        <div class="">
                            <p class="mb-5 opacity-5" data-aos="fade-left" data-aos-delay="200"> {{ $subtitle }}</p>
                            @isset($button)
                                <p data-aos="fade-left" data-aos-delay="300"><a href="{{ $button['link'] }}"
                                        class="btn btn-primary">{{ $button['text'] }}</a></p>
                            @endisset
                        </div>
                    @endisset
                </div>
            </div>

            @isset($youtube)
                <div class="col-lg-7" data-aos="fade-left">
                    <a href="{{ $youtube }}" class="video-bg glightbox">
                        <span class="icon"><span class="icon-play"></span></span>
                        @isset($image2)
                            <img src="{{ asset($image2) }}" alt="Image" class="img-fluid rounded">
                        @endisset
                    </a>
                </div>
            @endisset
        </div>
    </div>
</div>
