<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Detail;

use Illuminate\Support\Facades\Auth;

class hamburgerController extends Controller
{

    public function index(Request $request)
    {
        $posts = DB::select('select * from posts');
        // $posts = Post::Paginate(6);
        return view('hamburger',['posts'=>$posts]);
    }

    public function create() {

        return view('form');
    }

    public function store(Request $request)
    {
        $posts = DB::select('select * from posts');
        return view('hamburger',['posts'=>$posts]);

        // dd($request->file('image'));
        $filename='';
        if($request->hasFile('image')) {

            $filename=$request->file('image')->store('/img',['disk'=>'public']);
        }
        $item = [
            'name'=>$request->name,
            'price'=>$request->price,
            'detail'=>$request->detail,
            'imgpath'=>$filename,
        ];
        DB::insert('insert into posts(name,price,detail,imgpath)
        values(:name,:price,:detail,:imgpath)',$item);
        return redirect('/');
    }

    public function show(Request $request,$id,Post $post) {

        $authUser = Auth::user();
        $post = Post::find($id);

        $like = $post->likes()->where('user_id', Auth::user()->id)->first();

        return view ('show',[
            'authUser' => $authUser,
            'post' =>$post,
            'like' => $like,
        ]);
    }

    public function like(Request $request, $postId)
    {
        Like::create(
            array(
            'user_id' => Auth::user()->id,
            'post_id' => $postId
            )
        );

        $post = Post::findOrFail($postId);

        return redirect()
            ->action('hamburgerController@show', $post->id);
    }

    public function unlike($postId, $likeId) {

        try{
            $post = Post::findOrFail($postId);
            $post->like_by()->findOrFail($likeId)->delete();
            return redirect()
            ->route('hamburger.show', $postId);

        }catch(Exception $e){
            dd($e);
        }
      }

}
