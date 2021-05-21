@props(['post'])
<article class="brick entry" data-aos="fade-up">
  <div class="entry__thumb">
      <a href="{{ route('posts.display', $post->slug) }}" class="thumb-link">
          <img src="{{ getImage($post, true) }}" alt="" style="width:100%">
      </a>
  </div>
  <div class="entry__text">
      <div class="entry__header">
          <h1 class="entry__title"><a href="{{ route('posts.display', $post->slug) }}">{{ $post->title }}</a></h1>          
          <div class="entry__meta">
              <span class="byline"">@lang('By:')
                  <span class='author'>
                      <a href="{{ route('author', $post->user->id) }}">{{ $post->user->name }}</a>
                  </span>
              </span>
          </div>
      </div>
      <div class="entry__excerpt">
          <p>{{ $post->excerpt }}</p>
      </div>
      <a class="entry__more-link" href="{{ route('posts.display', $post->slug) }}">@lang('Read More')</a>
  </div>
</article>