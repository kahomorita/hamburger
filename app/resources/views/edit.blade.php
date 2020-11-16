@extends('layouts.app')

@section('content')

    投稿編集<br>

    <form action='{{ route('post_update') }}' method='post'>
        {{ csrf_field() }}
            <input type='hidden' name='id' value='{{ $post->id }}'><br>
            ユーザーID：{{ $post->user_id }}<br>
            タイトル：<input type='text' name='title' value='{{ $post->title }}'><br>
            内容：<input type='text' name='content' value='{{ $post->content }}'><br>
            <input type='submit' value='投稿'>
    </form>



@endsection
