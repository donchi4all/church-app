<div class="sermon-entry">
    <a href="{{ $link }}"><img src="{{ asset($image) }}" alt="Image" class="img-fluid mb-3 rounded"></a>
    <div class="sermon-body">
        <span class="date">{{ $date }} <span class="mx-2">&bullet;</span> By {{ $pastor }} </span>
        <h3 class="mb-2"><a href="{{ $link }}">{{ $title }}</a></h3>
        <p class="mb-5">{{ $description }}</p>
        <p><a href="{{ $link }}" class="btn btn-primary btn-sm">Read more</a></p>
    </div>
</div>
