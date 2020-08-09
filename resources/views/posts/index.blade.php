@extends('layouts.app')
@section('content')
    <h1 class="m-4 text-center">Bài viết</h1>
    @if(count($posts) > 0 )
        @foreach ($posts as $post)
            <div class="card p-3 mb-2">
                @if($post->cover_image !== "")
                    <div class="row">
                        <div class="col-md-11 col-sm-11">
                            <h3><a href="/posts/{{$post->id}}">{{$post->tieude}}</a></h3>
                            <small>Tải lên:{{$post->created_at}} bởi {{$post->user->name}}</small>
                        </div>
                        <div class="col-md-1 col-sm-1">
                            <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}" alt="">
                        </div>
                    </div>
                @else
                    <h3><a href="/posts/{{$post->id}}">{{$post->tieude}}</a></h3>
                    <small>Tải lên:{{$post->created_at}} bởi {{$post->user->name}}</small>
                @endif

            </div>
        @endforeach
        {{$posts->links()}}
    @else
        <p>No posts can be found</p>
    @endif
@endsection
