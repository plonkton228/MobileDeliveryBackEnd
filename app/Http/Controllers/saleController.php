<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
class saleController extends Controller
{
     public function index(Request $request)
    {
      $posts = Sale::where('user_id', $request->id)->get();
      return response()->json($posts);
    }
    public function addSale(Request $request)
    {
     Sale::create([
          'user_id'=> $request->input('params.user_id'),
          'post_id'=> $request->input('params.post_id'),
          'counter'=> 1
     ]);

    }

    public function update(Request $request)
    {
          if($request->input('params.type')== "sale")
     {
          
          $post = Sale::where("post_id", $request->input('params.post_id'))->where("user_id",  $request->input('params.user_id'))->pluck('counter');
          Sale::where("post_id", $request->input('params.post_id'))->where("user_id", $request->input('params.user_id'))->update(['counter'=>  $post[0]+ $request->input('params.counter')]);
     }
      elseif ($request->input('params.type') == "order") {
         foreach ($request->input('params.posts') as $key) {
              Sale::where("post_id", $key['id'])->where("user_id", $request->input('params.user_id'))->update(['counter'=>$key['counter']]);
         }
     }
          
    }
    public function DeletePost(Request $request)
    {
     
       Sale::destroy($request->input('id'));

      return response()->json("Success 200");
    }

      public function RootFunc (Request $request)
    {
      
        
      if(Sale::where("user_id",  $request->input('params.user_id'))->where("post_id", $request->input('params.post_id'))->exists() || $request->input('params.type') == "order")
      {
             
           $this->update($request);
      }
      else {
         
           $this->addSale($request);
      }

    }


}
