@props(['status'])
@if ($status)
    <div class="alert-box alert-box--info">
        <p>{{ $status }}</p>
        <span class="alert-box__close"></span>
    </div>
@endif