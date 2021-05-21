@extends('back.layout')
@section('main')
    <form 
        method="post" 
        action="{{ route('comments.update', $comment->id) }}">
        @method('PUT')
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
                        title='Contenu'
                        name='body'
                        :value='$comment->body'
                        input='textarea'
                        :required="true">
                    </x-back.input>
                </x-back.card>
                <button type="submit" class="btn btn-primary">@lang('Submit')</button>
              </div>
        </div>
    </form>
@endsection