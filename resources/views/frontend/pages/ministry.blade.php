@extends('frontend.layouts.app')

@section('title', 'Ministries')

@section('content')

    <!-- Hero Section -->
    <x-hero-section :title="$hero['title']" :subtitle="$hero['subtitle']" :image="$hero['image']" :button="[
            'text' => $hero['button_text'],
            'link' => $hero['button_link']
        ]"  :youtube="$hero['youtube']" :image2="$hero['image2']" />


    <div class="section">
        <div class="container">

            <div class="row g-5">
                @foreach ($recentSermons as $sermon)
                    <x-ministry-card :title="$sermon['title']" :readmore="'Read More'" :image="$sermon['image']" :description="$sermon['description']"
                        :link="$sermon['link']" />
                @endforeach
            </div>
        </div>
    </div>

@endsection
