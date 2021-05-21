@props(['errors'])
@if($errors->any())
    <x-back.alert 
        type='danger' 
        icon='ban' 
        title="{{ __('Whoops! Something went wrong.') }}">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </x-back.alert>
@endif