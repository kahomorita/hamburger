@extends('layouts.app')

@section('content')

<div class="show_box">
<img src="{{ asset('storage/' . $post->imgpath) }}" class="show_img">
@if($like)
      <!-- いいね取り消しフォーム -->
      {{ Form::open(
      ([
        'action' =>[
        'hamburgerController@unlike',
        $post->id, $like->id,
        ]
        ]
        )
        ) }}
        <button type="submit"><i class="fas fa-heart heart_pink fa-lg"></i></button>
          {{ $post->likes_count }}

      {!! Form::close() !!}
      @else
      {{-- いいねつける --}}
      {{ Form::model($post, array('action' => array('hamburgerController@like', $post->id))) }}
    <button type="submit" ><i class="far fa-heart heart_gray fa-lg"></i></button>
    {{ $post->likes_count }}

    {!! Form::close() !!}
      @endif
<p class="show_name">{{ $post->name }}</p>
<p>{{ $post->price}}円</p>
<p>{{ $post->detail}}</p>


<a href="{{ route('post_edit',$post->id) }}" style="color:blue;">編集</a>
<form action="{{ route('post_destroy',$post->id) }}" method="post" onsubmit="return checkDelete()" enctype='multipart/form-data'>
    {{ csrf_field() }}
<button type="submit">削除</button>

</div>



<script>
    function checkDelete() {
        if(window.confirm('削除してよろしいですか？')){
            return true;
        }else {
            return false;
        }
    }

</script>


@endsection



