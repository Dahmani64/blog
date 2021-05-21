@extends('front.layout')
@section('main')
    <div class="row">
        <div class="column large-12">
          <article class="s-content__entry">
            <div class="s-content__entry-header">
                <h1 class="s-content__title">@lang($page->title)</h1>
            </div>
            <div class="s-content__primary">
                <div class="s-content__page-content">
                    {!! $page->body !!}
                </div>
            </div>
        </article>
        </div>
    </div>
@endsection