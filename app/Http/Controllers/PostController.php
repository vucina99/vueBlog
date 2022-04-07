<?php

namespace App\Http\Controllers;

use App\Http\Traits\ResponseCodeTrait;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    use ResponseCodeTrait;

    public function posts(){
        return view("posts");
    }
    public function logout(){
       if(Auth::check()){
           Auth::logout();

           return redirect("/");
       }
       return redirect("/login");
    }

    public function postsData($page = 0){
        $posts = Post::skip($page*8)->take(8)->get();
        $postCount = ceil(Post::count() / 8);
        return response(["data" => $posts , "count" => $postCount ]);
    }

    public function updatePost(){
        $post = Post::find(request()->id);

        if($post){

            $post->title = request()->title ;
            $post->description = request()->description;

            $post->save();

            return response(['status' => true]);
        }
        return response(['status' => false]);
    }
    public function uploadImage(){
        $path = request()->file("image")->store('images' , 'public');

        return $this->success($path);
    }

    public function uploadPost(){
       
        $post = new Post();
        $post->title = request()->title;
        $post->description = request()->description;
        $post->img = request()->img;
        $post->user_id = request()->user_id['id'];
        $post->save();

        return $this->success("success added");

    }

    public function deletePost(){
        $data = Post::find(request()->id);

        if($data){
            $img_path = public_path($data->img);
            if(File::exists($img_path)){
                
                File::delete($img_path);
            }
            
            $data->delete();
            return response("success");
        }

        abort(500);
    }


    public function fullPost($post_id){
        $post = Post::find($post_id);
        
        return view("full-post" , compact('post'));
    }

}
