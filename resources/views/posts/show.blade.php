@extends('layouts.app')

@section('content')
<a href="/posts" class="btn btn-info mt-4"> <- Trở về</a>
<div class='mt-4'>
    @if ($post->cover_image !== "")
    <div class="col-12" >
        <div class="text-center">
        <img height="300px" width="auto" src="/storage/cover_images/{{$post->cover_image}}" alt="">
        </div>
    </div>
    @endif
<h1>{{$post->tieude}}</h1>
<p>{!!$post->noidung!!} </p>
<br>
<small>Tải lên: {{$post->created_at}}</small>
<hr>
@if(!Auth::guest())
    @if (Auth::user()->id == $post->user_id)
        <a href="{{route('posts.edit',$post->id)}}" class="btn btn-primary">Edit</a>
        <form class="float-right" action="{{ route('posts.destroy', $post->id) }}" method="POST" >
            @csrf
            @method('delete')
            <button class="btn btn-danger" type="submit">Xoá</button>
        </form>
    @endif
@endif
</div>
@endsection
