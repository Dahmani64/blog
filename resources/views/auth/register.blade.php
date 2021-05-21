@extends('front.layout')
@section('main')
    <div class="row row-x-center s-styles">
        <div class="column large-6 tab-12">
            <!-- Validation Errors -->
            <x-auth.validation-errors :errors="$errors" />
            <h3 class="h-add-bottom">@lang('Register')</h3>
            <form class="h-add-bottom" method="POST" action="{{ route('register') }}">
                @csrf
                
                <!-- Name -->
                <div>
                  <label for="name">@lang('Name')</label>  
                  <input 
                      id="name" 
                      class="h-full-width" 
                      type="text" 
                      name="name" 
                      placeholder="@lang('Your name')" 
                      value="{{ old('name') }}" 
                      required 
                      autofocus>
                </div>
                <!-- Email Address -->
                <x-auth.input-email />
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
               <!-- RGPD -->
               <x-auth.rgpd-checkbox />
               <x-auth.submit title="Register" />
                
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <x-auth.rgpd-script />
@endsection