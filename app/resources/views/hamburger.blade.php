
@extends('layouts.app')

@section('content')

   <div class="container_box">
	   <img src="img/IMG_7134.JPG" class="main_img">
	   <div class="img_logo">大阪のハンバーガー。</div>
	   <div class="mx-auto" style="max-width:1200px">

		   <!-- <h1 style="color:#303030; text-align:center; font-size:1.2em;
			padding:50px 0px 24px 0px; font-weight:bold;">home</h1> -->
		   <div class="">
			   <div class="d-flex flex-row flex-wrap box_wrap">
                   @foreach($posts as $post)
					   <div class="box">
                        <a href="{{ route('hamburger.show',[$post->id]) }}">
                                <img src="storage/{{$post->imgpath}}" class="post_img"><br>
                                <img src="/img/hamburger_icon.png" class="hamburger_icon">{{$post->name}} <br>
                        </a>
                        </div>
                    @endforeach

                    

			   </div>
		   </div>
	   </div>
   </div>

@endsection
