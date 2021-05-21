@props([
    'type', 
    'icon' => 'check', 
    'title' => '',
])
<div class="alert alert-{{ $type }} alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><span class="icon fa fa-{{ $icon }}"></span>{{ $title }}</h5>
    {{ $slot }}
</div>