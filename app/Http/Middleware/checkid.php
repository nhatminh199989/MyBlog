<?php

namespace App\Http\Middleware;
use App\Post;
use Closure;

class checkid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $post_id = $request->route('post');
        $post = Post::find($post_id);
        $user_id = $post->user_id;
        if($user_id == auth()->user()->id){
            return $next($request);
        }else{
            return redirect("/posts")->with('error','Bạn không có quyền truy cập trang này');
        }
    }
}
