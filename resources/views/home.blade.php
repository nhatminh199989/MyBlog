@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                <a href="{{route('posts.create')}}" class="btn btn-primary">Đăng bài</a>
                <hr>
                <h1 class="mt-3 text-center">Các bài đăng của bạn</h1>
                <p class="float-right">Số bài viết của bạn: {{count($posts)}}</p>
                @if(count($posts) > 0 )
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Tiêu đề</th>
                        <th>Edit</th>
                        <th>Xoá</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td >{{$post->tieude}}</td>
                            <td style="width:10%">
                                <a href="{{route('posts.edit',$post->id)}}" class="btn btn-primary">Edit</a>
                            </td>
                            <td style="width:10%">
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" >
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger" type="submit">Xoá</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                  </table>
                @else

                @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
