@extends('layouts.app')

@section('content')

<div class="wrap_show_box">
<div class="show_box">
    <div class="show_innner_box">
        <img src="{{ asset('storage/' . $post->img_path) }}" class="show_img">
    </div>
    <div class="show_innner_box">
        <p class="show_name">{{ $post->name }}</p>
        <p class="show_info">{{ $post->price}}円</p>
        <p class="show_info">{{ $post->city_name }}</p>
        <p class="show_info">{{ $post->store_name }}</p>
        <p>{{ $post->detail}}</p>
        @if($like)
        <!-- いいね取り消しフォーム -->
            <form action="{{route('post_unlike',array($post->id,$like->id))}}" method="post">
                @csrf
                <button type="submit"><i class="fas fa-heart heart_pink fa-lg"></i></button>
                {{ $post->likes_count }}
            </form>
        @else
            {{-- いいねつける --}}
            <form action="{{route('post_like',$post->id)}} " method="post">
                @csrf
                <button type="submit" ><i class="far fa-heart heart_gray fa-lg"></i></button>
                {{ $post->likes_count }}
            </form>
        @endif
    </div>
</div>
@can('edit', $post)

<div class="edit">
    <button type="button" onclick="window.location='{{ route('post_edit',$post->id) }}'">編集</button>
    <form action="{{ route('post_destroy',$post->id) }}" method="post" onsubmit="return checkDelete()" enctype='multipart/form-data'>
        @csrf
    <button type="submit" style="color:#af3535;">削除</button>
    </form>
</div>
@endcan
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



