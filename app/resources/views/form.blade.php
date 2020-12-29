@extends('layouts.app')

@section('content')

<div class="container_box">
	<div class="form_box">
        <p class="new_post">New Post</p>
        <form action="{{ route('hamburger_store') }}" method="post" onsubmit="return checkCheck()" enctype='multipart/form-data'>
            {{ csrf_field() }}
            <p>商品名</p><input type="text" name="name"><br>
            @if($errors->has('name'))
                <div style="color:red;">{{$errors->first('name')}}</div>
            @endif

            <p>値段</p><input type="text" name="price"><br>
            @if($errors->has('price'))
                <div style="color:red;">{{$errors->first('price')}}</div>
            @endif

            <p>商品情報</p><textarea type="text" name="detail"></textarea><br>
            @if($errors->has('detail'))
                <div style="color:red;">{{$errors->first('detail')}}</div>
            @endif

            <p>場所</p>
            <select name="city">
            @foreach(config('city') as $index => $city)
                <option value="{{ $index }}">{{ $city }}</option>
            @endforeach
            </select>

            <input type="file" name="image"><br>
            @if($errors->has('image'))
                <div style="color:red;">{{$errors->first('photo')}}</div>
            @endif

            <input type="submit" value="投稿する">
	</form>
	</div>
</div>

<script>
    function checkCheck() {
        if(window.confirm('投稿してよろしいですか？')){
            return true;
        }else {
            return false;
        }
    }
</script>

@endsection
