@extends('layouts.app')
@section('content')
    <h1 class="mt-4 mb-4 text-center">Edit posts</h1>
    @if ($post->cover_image !== "")
    <div class="col-12" >
        <div class="text-center">
        <img height="300px" width="auto" src="/storage/cover_images/{{$post->cover_image}}" alt="">
        </div>
    </div>
    <br>
    @endif
<form action="{{route('posts.update',$post->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="custom-file mb-3">
            <input type="file" class="custom-file-input" id="customFile" name="cover_image">
        <label class="custom-file-label" for="customFile">{{$post->cover_image}}</label>
        </div>
        <div class="form-group row">
            <label for="colFormLabelLg" class="col-sm-1 col-form-label col-form-label-lg" >Tiêu đề:</label>
            <div class="col-sm-11">
            <input value="{{$post->tieude}}" name="tieude" type="text" class="form-control form-control-lg">
            </div>
        </div>
        <div class="form-group">
            <label class="col-form-label col-form-label-lg">Nội dung:</label>
        <textarea name="noidung" class="form-control"  rows="10">{!!$post->noidung!!}</textarea>
        </div>
        <button type="submit" class="btn btn-primary mb-2 btn-lg float-right">Sửa</button>
    </form>
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js" type="text/javascript" charset="utf-8"></script>
    <script>
        CKEDITOR.replace('noidung');
        $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endsection
