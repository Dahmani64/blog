@extends('front.layout')
@section('main')
<!-- post
================================================== -->
<div class="row">
  <div class="column large-12">
      <article class="s-content__entry format-standard">
          <div class="s-content__media">
              <div class="s-content__post-thumb">
                  <img src="{{ getImage($post) }}" alt="" style="width:100%">
              </div>
          </div>
          <div class="s-content__entry-header">
              <h1 class="s-content__title s-content__title--post">{{ $post->title }}</h1>
          </div>
          <div class="s-content__primary">
              <div class="s-content__entry-content">
                  {!! $post->body !!}
              </div>
              <div class="s-content__entry-meta">
                  <div class="entry-author meta-blk">
                      <div class="author-avatar">
                          <img class="avatar" src="{{ Gravatar::get($post->user->email) }}" alt="">
                      </div>
                      <div class="byline">
                           <span class="bytext">@lang('Posted By')</span>
                           <a href="{{ route('author', $post->user->id) }}">{{ $post->user->name }}</a>
                      </div>
                  </div>
                  <div class="meta-bottom">
                      
                      <div class="entry-cat-links meta-blk">
                         
                      <div class="cat-links">
                          <span>@lang('In')</span> 
                           @foreach ($post->categories as $category)
                             <a href="{{ route('category', $category->slug) }}">{{ $category->title }}</a>
                           @endforeach
                      </div>
                          <span>@lang('On')</span>
                          {{ formatDate($post->created_at) }}
                      </div>
                      <div class="entry-tags meta-blk">
                          <span class="tagtext">@lang('Tags')</span>
                           @foreach($post->tags as $tag)
                           <a href="{{ route('tag', $tag->slug) }}">{{ $tag->tag }}</a>
                           @endforeach
                     </div>
                  </div>
              </div>
              <div class="s-content__pagenav">
                  @isset($post->previous)
                      <div class="prev-nav">
                          <a href="{{ route('posts.display', $post->previous->slug) }}" rel="prev">
                              <span>@lang('Previous')</span>
                              {{ $post->previous->title }}
                          </a>
                      </div>
                  @endisset
                  @isset($post->next)
                      <div class="next-nav">
                          <a href="{{ route('posts.display', $post->next->slug) }}" rel="next">
                              <span>@lang('Next One')</span>
                              {{ $post->next->title }}
                          </a>
                      </div>
                  @endisset
               </div>
          </div>
      </article>
  </div>
</div>
<!-- comments
================================================== -->
<div class="comments-wrap">
  <div id="comments" class="row">
      <div id="commentsList" class="column large-12">      
          @if($post->valid_comments_count > 0)
              <div id="forShow">
                  <p id="showbutton" class="text-center">
                      <a id="showcomments" href="{{ route('posts.comments', $post->id) }}" class="btn h-full-width">@lang('Show comments')</a>
                  </p>
                  <p id="showicon" class="h-text-center" hidden>
                      <span class="fa fa-spinner fa-pulse fa-3x fa-fw"></span>
                  </p>
              </div>
          @endif
      </div>
  </div>

  
  @if(Auth::check())
    <div class="row comment-respond">
        <div id="respond" class="column">
            <h3>@lang('Add Comment')
                <span id="forName"></span>
                <span><a id="abort" hidden href="#">@lang('Abort reply')</a></span>
            </h3>
            <div id="alert" class="alert-box" style="display: none">
                <p></p>
                <span class="alert-box__close"></span>
            </div>  
            <form id="messageForm" method="post" action="{{ route('posts.comments.store', $post->id) }}" autocomplete="off">
                <input id="commentId" name="commentId" type="hidden" value="">
                <div class="message form-field">
                    <textarea name="message" id="message" class="h-full-width" placeholder="@lang('Your Message')"></textarea>
                </div>
                <br>
                <p id="forSubmit" class="text-center">
                    <input name="submit" id="submit" class="btn btn--primary btn-wide btn--large h-full-width" value="@lang('Add Comment')" type="submit">
                </p>
                <p id="commentIcon" class="h-text-center" hidden>
                    <span class="fa fa-spinner fa-pulse fa-3x fa-fw"></span>
                </p>
            </form> 
        </div>
    </div>
  @endif
</div>
@endsection


@section('scripts')
    <script>
      (() => {
          // Variables
          const headers = {
              'X-CSRF-TOKEN': '{{ csrf_token() }}', 
              'Content-Type': 'application/json',
              'Accept': 'application/json',
              'X-Requested-With': 'XMLHttpRequest'
          }
          // Prepare show comments
          const prepareShowComments = e => {
              e.preventDefault();
              document.getElementById('showbutton').toggleAttribute('hidden');
              document.getElementById('showicon').toggleAttribute('hidden');
              showComments(); 
          }
          // Show comments
          const showComments = async () => {
              // Send request
              const response = await fetch('{{ route("posts.comments", $post->id) }}', { 
                  method: 'GET',
                  headers: headers
              });
              // Wait for response
              const data = await response.json();
              document.getElementById('commentsList').innerHTML = data.html;
          }
          // Listener wrapper
          const wrapper = (selector, type, callback, condition = 'true', capture = false) => {
              const element = document.querySelector(selector);
              if(element) {
                  document.querySelector(selector).addEventListener(type, e => { 
                      if(eval(condition)) {
                          callback(e);
                      }
                  }, capture);
              }
          };
          // Set listeners
          window.addEventListener('DOMContentLoaded', () => {
              wrapper('#showcomments', 'click', prepareShowComments);              
          })
      })()
    </script> 

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
      (() => {
          // Variables
          const headers = {
              'X-CSRF-TOKEN': '{{ csrf_token() }}', 
              'Content-Type': 'application/json',
              'Accept': 'application/json',
              'X-Requested-With': 'XMLHttpRequest'
          }
          const commentId = document.getElementById('commentId');
          const alert = document.getElementById('alert');
          const message = document.getElementById('message');
          const forName = document.getElementById('forName');
          const abort = document.getElementById('abort');
          const commentIcon = document.getElementById('commentIcon');
          const forSubmit = document.getElementById('forSubmit');
          // Add comment
          const addComment = async e => {
              e.preventDefault();
              // Get datas
              const datas = {
                  message: message.value
              };
              if(document.querySelector('#commentId').value != '') {
                  datas['commentId'] = commentId.value;
              } 
              // Icon
              commentIcon.hidden = false;
              forSubmit.hidden = true;
              // Send request
              const response = await fetch('{{ route("posts.comments.store", $post->id) }}', { 
                  method: 'POST',
                  headers: headers,
                  body: JSON.stringify(datas)
              });
              // Wait for response
              const data = await response.json();
              // Icon
              commentIcon.hidden = true;
              forSubmit.hidden = false;
              // Manage response
              if (response.ok) {
                  purge();
                  if(data == 'ok') {
                      showComments();
                      showAlert('success', '@lang("Your comment has been saved")');
                  } else {
                      showAlert('info', "@lang('Thanks for your comment. It will appear when an administrator has validated it. Once you are validated your other comments immediately appear.')");
                  }
              } else {
                  if(response.status == 422) {
                      showAlert('error', data.errors.message[0]);
                  } else {                
                      errorAlert();
                  }                
              }       
          }
          const errorAlert = () =>  Swal.fire({
                                      icon: 'error',
                                      title: '@lang("Whoops!")',
                                      text: '@lang("Something went wrong!")'
                                    });          
          // Show alert
          const showAlert = (type, text) => {
              alert.style.display = 'block';
              alert.className = '';
              alert.classList.add('alert-box', 'alert-box--' + type);
              alert.firstChild.textContent = text;
          }
          // Hide alert
          const hideAlert = () => alert.style.display = 'none';
          // Prepare show comments
          const prepareShowComments = e => {
              e.preventDefault();
              document.getElementById('showbutton').toggleAttribute('hidden');
              document.getElementById('showicon').toggleAttribute('hidden');
              showComments(); 
          }
          // Show comments
          const showComments = async () => {
              // Send request
              const response = await fetch('{{ route("posts.comments", $post->id) }}', { 
                  method: 'GET',
                  headers: headers
              });
              // Wait for response
              const data = await response.json();
              document.getElementById('commentsList').innerHTML = data.html;
              @if(Auth::check())
                  document.getElementById('respond').hidden = false;
              @endif
          }
          // Reply to comment
          const replyToComment = e => {              
              e.preventDefault();
              forName.textContent = `@lang('Reply to') ${e.target.dataset.name}`;
              commentId.value = e.target.dataset.id;
              abort.hidden = false;
              message.focus();
          }
          // Abort reply
          const abortReply = (e) => {
              e.preventDefault();
              purge();       
          }
          // Purge reply
          const purge = () => {
              forName.textContent = '';
              commentId.value = '';                
              message.value = '';
              abort.hidden = true; 
          }
          // Listener wrapper
          const wrapper = (selector, type, callback, condition = 'true', capture = false) => {
              const element = document.querySelector(selector);
              if(element) {
                  document.querySelector(selector).addEventListener(type, e => { 
                      if(eval(condition)) {
                          callback(e);
                      }
                  }, capture);
              }
          };
          // Set listeners
          window.addEventListener('DOMContentLoaded', () => {
              wrapper('#showcomments', 'click', prepareShowComments);              
              wrapper('#abort', 'click', abortReply);
              wrapper('#message', 'focus', hideAlert);
              wrapper('#messageForm', 'submit', addComment);
              wrapper('#commentsList', 'click', replyToComment, "e.target.matches('.replycomment')");
          })


          // Delete comment
const deleteComment = async e => {              
    e.preventDefault();
    Swal.fire({
      title: '@lang('Really delete this comment?')',
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "@lang('Yes')",
      cancelButtonText: "@lang('No')",
      preConfirm: () => {
          return fetch(e.target.getAttribute('href'), { 
              method: 'DELETE',
              headers: headers
          })
          .then(response => {
              if (response.ok) {
                  showComments();
              } else {
                  errorAlert();
              }
          });
      }
    });
}
// Set listeners
window.addEventListener('DOMContentLoaded', () => {
    
    wrapper('#commentsList', 'click', deleteComment, "e.target.matches('.deletecomment')");
})
      })()


      

    </script> 
   
@endsection