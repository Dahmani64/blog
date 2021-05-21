@extends('back.layout')
@section('main')
    <form 
        method="post" 
        action="{{ Route::currentRouteName() === 'follows.edit' ? route('follows.update', $follow->id) : route('follows.store') }}">
        @if(Route::currentRouteName() === 'follows.edit')
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
                        :value="isset($follow) ? $follow->title : ''"
                        input='text'
                        :required="true">
                    </x-back.input>
                    <x-back.input
                        title='Lien'
                        name='href'
                        :value="isset($follow) ? $follow->href : ''"
                        input='text'
                        :required="true">
                    </x-back.input>
                </x-back.card>
                <button type="submit" class="btn btn-primary">@lang('Submit')</button>
              </div>
        </div>
    </form>
@endsection