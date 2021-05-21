@extends('front.layout')
@section('main')
    <div class="row">
        <div class="column large-12">
            <div class="s-content__entry-header">
                <h1 class="s-content__title">@lang('Get In Touch With Us')</h1>
            </div>
            <div class="row row-x-center">
                <div class="column large-6 tab-12">
                  <!-- Session Status -->
                  <x-auth.session-status :status="session('status')" />
                  <!-- Validation Errors -->
                  <x-auth.validation-errors :errors="$errors" />
                  <form class="s-content__form" method="post" action="{{ route('contacts.store') }}">
                      @csrf
                      <fieldset>
                          @if(Auth::guest())
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
                          @endif
                          <!-- Message -->                          
                          <label for="message">@lang('Your Message')</label> 
                          <textarea name="message" id="message" class="h-full-width" placeholder="@lang('Your Message')" required>{{ old('message') }}</textarea>                          
                          
                          <br>
                          
                          @if(Auth::guest())
                            <x-auth.rgpd-checkbox />
                          @endif

                          <x-auth.submit title="Send" />
                      </fieldset>
                  </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @if(Auth::guest())
        <x-auth.rgpd-script />    
    @endif
@endsection