
@extends('layouts.app')

@section('content')

    <div class="container_box">
        <img src="img/IMG_7134.JPG" class="main_img">
	   <div class="mx-auto" style="max-width:1200px">

		   <!-- <h1 style="color:#303030; text-align:center; font-size:1.2em;
			padding:50px 0px 24px 0px; font-weight:bold;">home</h1> -->

			   <div class="d-flex flex-wrap box_wrap">
                   @foreach($posts as $post)
                   <div class="post_box">
					   <div class="box">
                            <a href="{{ route('hamburger.show',[$post->id]) }}">
                                    <img src="storage/{{$post->imgpath}}" class="post_img"><br>
                            </a>
                        </div>
                        <div class="post_data">
                        <p class="post_name">{{$post->name}}</p>
                        @php
                            $day = new DateTime($post->created_at);
                        @endphp
                        <p class="date">{{$day->format('Y.m.d')}}</p>
                        </div>
                    </div>
                    @endforeach
                </div>



		   </div>
	   </div>

@endsection
