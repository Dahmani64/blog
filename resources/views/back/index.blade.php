@extends('back.layout') 
@section('main') 
  <div class="container-fluid">
      <div class="row">
        @if($posts)
          <x-back.box
            type='info'
            :number='$posts'
            title='New posts'
            route='posts.indexnew'
            model='post'>
          </x-back.box>
        @endif
        @if($users)
          <x-back.box
            type='success'
            :number='$users'
            title='New users'
            route='users.indexnew'
            model='user'>
          </x-back.box>
        @endif
        @if($contacts)
          <x-back.box
            type='primary'
            :number='$contacts'
            title='New contacts'
            route='contacts.indexnew'
            model='contact'>
          </x-back.box>
        @endif
        @if($comments)
          <x-back.box
            type='danger'
            :number='$comments'
            title='New comments'
            route='comments.indexnew'
            model='comment'>
          </x-back.box>
        @endif 
      </div>      
  </div>
@endsection