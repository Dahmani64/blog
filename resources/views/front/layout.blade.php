<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

<!--================================================== -->
<title>{{ isset($post) && $post->seo_title ? $post->seo_title :  config('app.name') }}</title>
<meta name="description" content="{{ isset($post) && $post->meta_description ? $post->meta_description : __(config('app.description')) }}">
<meta name="author" content="{{ isset($post) ? $post->user->name : __(config('app.author')) }}">
@if(isset($post) && $post->meta_keywords)
    <meta name="keywords" content="{{ $post->meta_keywords }}">
@endif

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>{{ config('app.name') }}</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="{{ asset('css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @yield('style')

    <!-- script
    ================================================== -->
    <script src="{{ asset('js/modernizr.js') }}"></script>
    <script defer src="{{ asset('js/fontawesome/all.min.js') }}"></script>

    <!-- favicons
    ================================================== -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

</head>

<body id="top">


    <!-- preloader
    ================================================== -->
    <div id="preloader"> 
    	<div id="loader"></div>
    </div>


    <!-- header
    ================================================== -->
    <header class="s-header @unless(currentRoute('home')) s-header--opaque @endunless">
    <div class="s-header__logo">
        <a class="logo" href="{{ route('home') }}">
            <img src="{{ asset('images/logo.svg') }}" alt="Homepage">
        </a>
    </div>
    <div class="row s-header__navigation">
        <nav class="s-header__nav-wrap">
            <h3 class="s-header__nav-heading h6">@lang('Navigate to')</h3>
            <ul class="s-header__nav">
                <li {{ currentRoute('home') }}>
                    <a href="{{ route('home') }}" title="">@lang('Home')</a>
                </li>
                <li class="has-children">
                     <a href="#" title="">@lang('Categories')</a>
                     <ul class="sub-menu">
                        @foreach($categories as $category)
                          <li>
                            <a href="{{ route('category', $category->slug) }}">{{ $category->title }}</a>
                          </li>
                          @endforeach
                      </ul>
                </li>
                 <li {{ currentRoute('contacts.create') }}>
                         <a href="{{ route('contacts.create') }}" title="">@lang('Contact')</a>
                 </li>
                @guest                        
                    @request('register')
                <li class="current">
                        <a href="{{ request()->url() }}">@lang('Register')</a>
               </li>
                    @endrequest
               <li {{ currentRoute('login') }}>
                      <a href="{{ route('login') }}">@lang('Login')</a>
               </li>
               @request('forgot-password')
               <li class="current">
                      <a href="{{ request()->url() }}">@lang('Password')</a>
               </li>
               @endrequest
                @request('reset-password/*')
              <li class="current">
                   <a href="{{ request()->url() }}">@lang('Password')</a>
             </li>
                @endrequest
                 @else
                    @if(auth()->user()->role != 'user')
                      <li>
                              <a href="{{ url('admin') }}">@lang('Administration')</a>
                     </li>
                     @endif
                    <li class="has-children">
                              <a href="#" title="">{{ auth()->user()->name }}</a>
                              <ul class="sub-menu">
                                 <li>
                                    <form action="{{ route('logout') }}" method="POST" hidden>
                                        @csrf                                
                                    </form>
                                   <a 
                                     href="{{ route('logout') }}"
                                     onclick="event.preventDefault(); this.previousElementSibling.submit();">
                                     @lang('Logout')
                                   </a>
                                 </li>
                                <li><a href="{{ url('profile') }}">@lang('Profile')</a></li>
                               </ul>
                     </li>
                  @endguest
            </ul>
            <a href="#0" title="@lang('Close Menu')" class="s-header__overlay-close close-mobile-menu">@lang('Close')</a>
        </nav>
    </div>
    <a class="s-header__toggle-menu" href="#0" title="@lang('Menu')"><span>@lang('Menu')</span></a>
    <div class="s-header__search">
        <div class="s-header__search-inner">
            <div class="row wide">
            <form role="search" method="get" class="s-header__search-form" action="{{ Route('posts.search') }}">
               <label>
                    <span class="h-screen-reader-text">@lang('Search for:')</span>
                    <input id="search" type="search" name="search" class="s-header__search-field" placeholder="@lang('Search for...')" title="@lang('Search for:')" autocomplete="off">
               </label>
               <input type="submit" class="s-header__search-submit" value="Search"> 
           </form>
                <a href="#0" title="@lang('Close Search')" class="s-header__overlay-close">@lang('Close')</a>
            </div>
        </div>
    </div>
    <a class="s-header__search-trigger" href="#">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17.982 17.983"><path fill="#010101" d="M12.622 13.611l-.209.163A7.607 7.607 0 017.7 15.399C3.454 15.399 0 11.945 0 7.7 0 3.454 3.454 0 7.7 0c4.245 0 7.699 3.454 7.699 7.7a7.613 7.613 0 01-1.626 4.714l-.163.209 4.372 4.371-.989.989-4.371-4.372zM7.7 1.399a6.307 6.307 0 00-6.3 6.3A6.307 6.307 0 007.7 14c3.473 0 6.3-2.827 6.3-6.3a6.308 6.308 0 00-6.3-6.301z"/></svg>
    </a>
</header>


    <!-- hero
    ================================================== -->
    @yield('hero')


    <!-- content
    ================================================== -->
    <section class="s-content @if(currentRoute('home')) s-content--no-top-padding @endif">
        @yield('main')

    </section>


    <!-- footer
    ================================================== -->
    <footer class="s-footer">
    <div class="s-footer__main">
        <div class="row">
            <div class="column large-6 medium-6 tab-12 s-footer__info">
                <h5>@lang('About Our Site')</h5>
                <p>
                Lorem ipsum Ut velit dolor Ut labore id fugiat in ut 
                fugiat nostrud qui in dolore commodo eu magna Duis 
                cillum dolor officia esse mollit proident Excepteur 
                exercitation nulla. Lorem ipsum In reprehenderit 
                commodo aliqua irure.
                </p>
            </div>
            <div class="column large-3 medium-3 tab-6 s-footer__site-links">
                <h5>@lang('Site Links')</h5>
                <ul>
                    @foreach($pages as $page)
                        <li><a href="{{ route('page', $page->slug) }}">@lang($page->title)</a></li>
                    @endforeach
                </ul>
            </div> 
            <div class="column large-2 medium-3 tab-6 s-footer__social-links">
               <h5>@lang('Follow Us')</h5>
               <ul>
                    @foreach($follows as $follow)
                    <li><a href="{{ $follow->href }}">{{ $follow->title }}</a></li>
                     @endforeach
               </ul>
           </div>
        </div>
    </div>
    <div class="s-footer__bottom">
        <div class="row">
            <div class="column">
                <div class="ss-copyright">
                    <span>© Copyright Calvin 2020</span> 
                    <span>Design by <a href="https://www.styleshout.com/">StyleShout</a></span>
                </div>
            </div>
        </div> 
        <div class="ss-go-top">
            <a class="smoothscroll" title="Back to Top" href="#top">
                <svg viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg" width="15" height="15"><path d="M7.5 1.5l.354-.354L7.5.793l-.354.353.354.354zm-.354.354l4 4 .708-.708-4-4-.708.708zm0-.708l-4 4 .708.708 4-4-.708-.708zM7 1.5V14h1V1.5H7z" fill="currentColor"></path></svg>
            </a>
        </div>
    </div>
</footer> <!-- end s-footer -->


    <!-- JavaScript
    ================================================== -->
   <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>-->
    <script src="http://localhost/psd/jquery-3.4.1.js"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @yield('scripts')

</body>

</html>