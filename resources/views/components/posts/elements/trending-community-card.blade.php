<div class="tc-card">
    <img class="tc-img" src="{{ $suggestion->icon }}" alt="">
    <div class="tc-card-text">
        <div class="tc-subreddit">
            <a href="/r/{{ $suggestion->handle}}">
                r/{{ $suggestion->handle }}
            </a>
        </div>
        <div class="tc-subcount">{{ number_format($suggestion->subscribersCount) }} subscribers</div>
    </div>
    <button class="tc-subs-button">Subscribe</button>
</div>