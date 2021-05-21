@props(['comments'])
@foreach($comments as $comment)
    <x-front.comments-base :comment="$comment"/>
@endforeach