<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {

         $posts = Post::where('category_id',$request->id)->get();
         return response()->json($posts);
    }

    public function show (Request $request)
    {
        $post = Post::where('id', $request->id)->get();
        return response()->json($post);
    }

    public function getPosts(Request $request)
    {
        $posts = [];
   
         if($request->input('ids') != [])
         {
            foreach ($request->ids as  $id) {  
            array_push($posts, Post::where('id',$id)->get());
           }
         }
       

        
              return response()->json($posts);  
         
    }

}
