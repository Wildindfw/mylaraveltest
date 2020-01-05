@extends('reddit_layouts.app') 

@section('main-feed-content')    
    <?php if (!Auth::check()): ?>
        @include('components.posts.sign-up-cta')
    <?php endif; ?>

    <?php foreach($posts as $post): ?>
        @include('components.posts.main-feed')
    <?php endforeach; ?>
@endsection
 
@section('aux-feed-content')
    @include('components.posts.popular')
    @include('components.posts.advertisement')
    @include('components.posts.reddit-premium')
    @include('components.posts.trending-communities')
    @include('components.posts.advertisement')
    @include('components.posts.footer')
@endsection