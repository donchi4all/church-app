@extends('frontend.layouts.app')

@section('title', $sermon['title'])

@section('content')
<div class="hero overlay" style="background-image: url('{{ asset('images/landscape-1.jpg') }}');">
    <h1>{{ $sermon['title'] }}</h1>
    <p>By {{ $sermon['pastor'] }}</p>
</div>

<div class="section">
    <p>{{ $sermon['content'] }}</p>

    <h3>Related Sermons</h3>
    @foreach($relatedSermons as $related)
        <div>
            <img src="{{ asset($related['image']) }}" alt="">
            <h4>{{ $related['title'] }}</h4>
        </div>
    @endforeach
</div>
@endsection
