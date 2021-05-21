
@extends('front.layout')
@section('main')
    <div class="row row-x-center s-styles">
        <div class="column large-6 tab-12">
            <!-- Session Status -->
            <x-auth.session-status :status="session('status')" />
            <!-- Validation Errors -->
            <x-auth.validation-errors :errors="$errors" />
            <p class="h-add-bottom">@lang('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.')</p>
            <form class="h-add-bottom" method="POST" action="{{ route('password.email') }}">
                @csrf                
                <!-- Email Address -->
                <x-auth.input-email />
                <x-auth.submit title="Email Password Reset Link" />
               
            </form>
        </div>
    </div>
@endsection