@extends('front.layout')
@section('main')
    <div class="row row-x-center s-styles">
        <div class="column large-6 tab-12">          
            <p class="h-add-bottom">@lang('This is a secure area of the application. Please confirm your password before continuing.')</p>
            <!-- Validation Errors -->
            <x-auth.validation-errors :errors="$errors" />
            <form class="h-add-bottom" method="POST" action="{{ route('password.confirm') }}">
                @csrf                
                <!-- Password -->
                <x-auth.input-password />
                <x-auth.submit title="Confirm" />              
            </form>
        </div>
    </div>
@endsection