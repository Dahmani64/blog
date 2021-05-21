@extends('front.layout')
@section('main')
    <div class="row row-x-center s-styles">
        <div class="column large-6 tab-12">
            <!-- Validation Errors -->
            <x-auth.validation-errors :errors="$errors" />
            <h3 class="h-add-bottom">@lang('Password reset')</h3>
            <form class="h-add-bottom" method="POST" action="{{ route('password.update') }}">
                @csrf
                
                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <!-- Email Address -->
                <x-auth.input-email :email="$request->email" />
                <!-- Password -->
                <x-auth.input-password />
                <!-- Confirm Password -->
                <div>
                  <label for="password_confirmation">@lang('Confirm Password')</label> 
                  <input 
                      id="password_confirmation" 
                      class="h-full-width" 
                      type="password" 
                      name="password_confirmation" 
                      placeholder="@lang('Confirm your Password')" 
                      required>
                </div>
                
                <x-auth.submit title="Reset Password" />
               
            </form>
        </div>
    </div>
@endsection