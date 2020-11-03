@extends('layouts.app')

@section('content')

<div class="show_box">
<img src="{{ asset('storage/' . $post->imgpath) }}" class="show_img">
<p class="show_name">{{ $post->name }}</p>
<p>{{ $post->price}}円</p>
<p>{{ $post->detail}}</p>

@if (Auth::check())
    @if ($like)
      <!-- いいね取り消しフォーム -->
      {{ Form::open(
      ([
        'action' =>[
        'hamburgerController@unlike',
        $post->id, $post->likes_count,
        ]
        ]
        )
        ) }}
        <button type="submit">♡ いいね消</button>
          {{ $post->likes_count }}

      {!! Form::close() !!}
    @endif

      <!-- いいねフォーム -->
      {{ Form::model($post, array('action' => array('hamburgerController@like', $post->id))) }}
        <button type="submit" ><i class="far fa-heart"></i>いいね</button>
          {{ $post->likes_count }}

      {!! Form::close() !!}

@endif
</div>




@endsection



