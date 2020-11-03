@extends('layouts.app')

@section('content')

  <div class="container_box">
	  <div class="form_box">
          <p class="new_post">New Post</p>

		<form action="/" method="post" enctype='multipart/form-data'>
        {{ csrf_field() }}
		<p>商品名</p><input type="text" name="name"><br>
		<p>値段</p><input type="text" name="price"><br>
		<p>商品情報</p><textarea type="text" name="detail"></textarea><br>
        <p>場所</p>
        <select>
        @foreach(config('city') as $index => $name)
            <option value="{{ $index }}">{{ $name }}</option>
        @endforeach
        </select>
		<input type="file" name="image"><br>
        <input type="submit" value="投稿する">
	</form>



	</div>
  </div>

@endsection
