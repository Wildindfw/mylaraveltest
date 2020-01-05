<div class="subreddit-card-post">
    <?php if($subreddit->banner): ?>
        <img class="subreddit-hero" src="{{ $subreddit->banner }}" alt="Subreddit banner image.">
    <?php else: ?>
        <div class="default-subreddit-hero"></div>
    <?php endif; ?>
    
    <img
        class="subreddit-icon" 
        src="{{ $subreddit->icon ? 
            $subreddit->icon : 
            'https://i.redd.it/130am13nj6201.png' }}" 
        alt="Subreddit icon image."
    />

    <span class="handle">r/{{ $subreddit->handle }}</span>
    
    <?php if($subreddit->description): ?>
        <p class="description">{{ $subreddit->description }}</p>
    <?php endif; ?>
    
    <a 
        class="new-post-button"
        href="/post/r/{{ $subreddit->handle }}"
    >
        New Post
    </a>
</div>