
@extends('layouts.app')

@section('content')
    <div class="container_box">
        <div class="main_img_box">
            {{-- <img src="img/tophamburger.jpg" class="main_img"> --}}
            <p class="main_logo"><span>O</span>saka <span>H</span>amburger</p>
        </div>
            <div class="mx-auto" style="max-width:1200px">
                <div class="d-flex flex-wrap box_wrap">
                    @foreach($posts as $post)
                    <div class="post_box">
                        <a href="{{ route('hamburger_show',[$post->id]) }}">
                            <img src="storage/{{$post->img_path}}" class="post_img"><br>
                        </a>
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
