@extends('back.layout')
@section('main')
    <form 
        method="post" 
        action="{{ route('users.update', $user->id) }}">
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
                        title='Name'
                        name='name'
                        :value='$user->name'
                        input='text'
                        :required="true">
                    </x-back.input>
                    <x-back.input
                        title='Email'
                        name='email'
                        :value='$user->email'
                        input='text'
                        :required="true">
                    </x-back.input>
                    <x-back.input
                        title='Role'
                        name='role'
                        :value='$user->role'
                        :options="['admin','redac','user']"
                        input='select'
                        :required="true">
                    </x-back.input>
                    <x-back.input
                        name='valid'
                        :value='$user->valid'
                        input='checkbox'
                        label="Valid">
                    </x-back.input>
                </x-back.card>
                <button type="submit" class="btn btn-primary">@lang('Submit')</button>
              </div>
        </div>
    </form>
@endsection