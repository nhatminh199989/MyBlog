<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('checkid')->only('edit','update','destroy');
        $this->middleware('auth',['except'=>['index','show']]);
    }

    public function index()
    {
        //$posts = Post::all();
        //$posts = DB::select("SELECT * FROM posts");
        $posts =  Post::orderBy('created_at','DESC')->paginate(5);
        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'tieude' => 'required',
            'noidung' => 'required',
            'cover_image' => 'image|nullable'
        ]);

        if($request->hasFile('cover_image')){
            //Get filename with  extension
            $file_name_ext = $request->file('cover_image')->getClientOriginalName();
            //Get filename
            $file_name = pathinfo($file_name_ext,PATHINFO_FILENAME);
            //Get file ext
            $file_ext = pathinfo($file_name_ext,PATHINFO_EXTENSION);
            //File name to store
            $file_name_store = $file_name.'_'.time().'.'.$file_ext;
            //Upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images',$file_name_store);
        }
        $post = new Post;
        $post->tieude = $request->input("tieude");
        $post->noidung = $request->input("noidung");
        $post->cover_image = $file_name_store;
        $post->user_id = auth()->user()->id;
        $post->save();
        return redirect("/posts")->with('success',"Đăng thành công !");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request,[
            'tieude' => 'required',
            'noidung' => 'required',
            'cover_image' => 'image|nullable'
        ]);
        $file_name_store ='';
        if($request->hasFile('cover_image')){
            //Get filename with  extension
            $file_name_ext = $request->file('cover_image')->getClientOriginalName();
            //Get filename
            $file_name = pathinfo($file_name_ext,PATHINFO_FILENAME);
            //Get file ext
            $file_ext = pathinfo($file_name_ext,PATHINFO_EXTENSION);
            //File name to store
            $file_name_store = $file_name.'_'.time().'.'.$file_ext;
            //Upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images',$file_name_store);

        }

        $post = Post::find($id);
        $post->tieude = $request->input('tieude');
        $post->noidung = $request->input('noidung');
        if($file_name_store !== ""){
            //Delete old image
            Storage::delete('public/cover_images/'.$post->cover_image);
            //Update new image name
            $post->cover_image = $file_name_store;
        }
        $post->save();
        return redirect("/posts")->with('success',"Edit thành công");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if($post->cover_image !== ""){
            Storage::delete('public/cover_images/'.$post->cover_image);
        }
        $post->delete();
        return redirect("/posts")->with("success","Xoá thành công");
    }
}
