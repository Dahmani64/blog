<h3>
    @lang('Comments')
    @if(Auth::guest())
        <span>@lang('You must be connected to add a comment or reply.')</span>
    @endif
</h3>
<!-- Commentlist -->
<ol class="commentlist">
    <x-front.comments :comments="$comments"/>
</ol>