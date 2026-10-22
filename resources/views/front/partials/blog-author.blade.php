@if($post->blogAuthor)
@php
    $author = $post->blogAuthor;
    $writtenOn = $post->published_at ?: $post->created_at;
    $bio = trim($author->bio);
    $bioPreview = \Illuminate\Support\Str::limit($bio, 280);
    $bioIsLong = $bioPreview !== $bio;
@endphp
<aside class="blog-author-card" aria-label="Written by {{ $author->name }}">
    <div class="blog-author-card-main">
        @if($author->photo_url)
            <img src="{{ $author->photo_url }}" alt="{{ $author->name }}" class="blog-author-photo">
        @else
            <span class="blog-author-photo blog-author-photo-fallback">{{ $author->initials }}</span>
        @endif
        <div class="blog-author-copy">
            <div class="blog-author-kicker">
                <span>Written by</span>
                <span class="blog-author-dot"></span>
                <span class="blog-author-date"><i class="far fa-calendar-alt"></i> {{ $writtenOn->format('F j, Y') }}</span>
            </div>
            <div class="blog-author-name-row">
                <strong>{{ $author->name }}</strong>
                @if($author->designation)
                    <span class="blog-author-dot"></span>
                    <span class="blog-author-role">{{ $author->designation }}</span>
                @endif
            </div>
        </div>
    </div>
    @if($bio !== '')
        <p class="blog-author-bio" id="blog-author-bio">{{ $bioIsLong ? $bioPreview : $bio }}</p>
        @if($bioIsLong)
            <button type="button" class="blog-author-more" id="blog-author-more">Read more</button>
            <span id="blog-author-bio-full" hidden>{{ $bio }}</span>
        @endif
    @endif
</aside>
@endif
