@props(['errors'])
@if ($errors->any())    
    <div class="alert-box alert-box--error">
        <div style="padding-bottom:1rem">@lang('Whoops! Something went wrong.')</div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <span class="alert-box__close"></span>
    </div> 
@endif