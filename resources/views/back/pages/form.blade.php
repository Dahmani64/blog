@extends('back.layout')
@section('main')
    <form 
        method="post" 
        action="{{ Route::currentRouteName() === 'pages.edit' ? route('pages.update', $page->id) : route('pages.store') }}">
        @if(Route::currentRouteName() === 'pages.edit')
            @method('PUT')
        @endif
        
        @csrf
        <div class="row">
          <div class="col-md-12">
                
                <x-back.validation-errors :errors="$errors" />
                @if(session('ok'))
                    <x-back.alert 
                        type='success'
                        title="{!! session('ok') !!}">
                    </x-back.alert>
                @endif
                <x-back.card
                    type='info'
                    :outline="true"
                    title=''>
                    <x-back.input
                        title='Title'
                        name='title'
                        :value="isset($page) ? $page->title : ''"
                        input='text'
                        :required="true">
                    </x-back.input>
                    <x-back.input
                        title='Slug'
                        name='slug'
                        :value="isset($page) ? $page->slug : ''"
                        input='text'
                        :required="true">
                    </x-back.input>
                    <x-back.input
                        title="Body"
                        name='body'
                        :value="isset($page) ? $page->body : ''"
                        input='textarea'
                        rows=10
                        :required="true">
                    </x-back.input>
                </x-back.card>
                <button type="submit" class="btn btn-primary">@lang('Submit')</button>
              </div>
        </div>
    </form>
@endsection
@section('js')
    @include('back.shared.editorScript')
@endsection