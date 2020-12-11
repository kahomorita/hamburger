@extends('layouts.app')

@section('content')

  <div class="container_box">
	  <div class="form_box">
          <p class="new_post">Edit Post</p>

		<form action="{{ route('post_update') }}" method="post" onsubmit="return checkCheck()" enctype='multipart/form-data'>
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{$post->id}}">
        <p>商品名</p><input type="text" name="name" value="{{$post->name}}"><br>
        <p>値段</p><input type="text" name="price" value="{{$post->price}}"><br>
        <p>商品情報</p><textarea type="text" name="detail">{{$post->detail}}</textarea><br>
        <p>場所</p>
        <select>
        @foreach(config('city') as $index => $name)
            <option value="{{ $index }}">{{ $name }}</option>
        @endforeach
        </select>
        <input type="file" name="image"><img class="edit_img" src='{{ asset('storage/' . $post->imgpath) }}'><br>
        <input type="submit" value="更新する">
	</form>



	</div>
  </div>

  <script>
    function checkCheck() {
        if(window.confirm('更新してよろしいですか？')){
            return true;
        }else {
            return false;
        }
    }

</script>


@endsection





