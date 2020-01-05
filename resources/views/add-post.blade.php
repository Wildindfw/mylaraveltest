@extends('reddit_layouts.app') 

@section('main-feed-content') 
    <form class="post-form" action="/post/r/{{ $subreddit->handle }}" method="post">
        @csrf
        
        <?php $requestContent = request()->all(); ?>
        <h1>New Post for /r/{{ $subreddit->handle }}</h1>
        <p>All fields are required.</p>
        @include('components.subcomponents.form-text-field', [
            'field' => 'title', 
            'label' => 'Title', 
            'isRequired' => true, 
            'default' => $requestContent['title'] ?? '', 
        ])

        <label for="content">Content:<span class="required">*</span></label>
        <textarea 
            name="content" 
            id="content" 
            cols="30" 
            rows="10"
            required
        >{{ old('content', request()->all()['content'] ?? '') }}</textarea>
        <?php if ($error = $errors->first('content')): ?>
            <p class="text-danger" role="alert">
                <strong>{{ $error }}</strong>
            </p>
        <?php endif; ?>

        <input type="submit" value="Create Post">
    </form>
@endsection 

@section('aux-feed-content') 
    @include('components.posts.subreddit-card') 
    @include('components.posts.footer') 
@endsection