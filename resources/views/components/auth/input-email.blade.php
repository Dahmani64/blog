@props(['email' => ''])
<div>
  <label for="email">@lang('Email')</label>  
  <input 
      id="email" 
      class="h-full-width" 
      type="email" 
      name="email" 
      placeholder="@lang('Your email')" 
      value="{{ old('email', $email) }}" 
      required 
      autofocus>
</div>