@props(['comment'])
<li class="comment">
  <div class="comment__avatar">
      <img class="avatar" src="{{ Gravatar::get($comment->user->email) }}">
  </div>
  <div class="comment__content">
      <div class="comment__info">
          <div class="comment__author">{{ $comment->user->name }}</div>
          <div class="comment__meta">
              <div class="comment__time">{{ formatDate($comment->created_at) }}</div>
              @if(Auth::check())
                  <div class="comment__reply">
                      @if($comment->depth < config('app.commentsNestedLevel'))
                          <a 
                              class="comment-reply-link replycomment" 
                              href="#" 
                              data-name="{{ $comment->user->name }}" 
                              data-id="{{ $comment->id }}">
                              @lang('Reply')
                          </a>
                      @endif
                      @if(Auth::user()->name == $comment->user->name)
                          <a 
                               href="{{ route('front.comments.destroy', $comment->id) }}"
                              class="comment-reply-link deletecomment" 
                              style="color:red">
                              @lang('Delete')
                          </a>
                      @endif 
                  </div>
              @endif
          </div>
      </div>
      <div class="comment__text">
          <p>{{ $comment->body }}</p>
      </div>
      <ul class="children">
          <x-front.comments :comments="$comment->children"/>
      </ul>
  </div>
</li>