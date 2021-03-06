<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Http\Request;
use App\Http\Requests\PostFormRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Detail;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;

class hamburgerController extends Controller
{

    public function index() {

        $posts = DB::select('select * from posts');
        return view('hamburger',['posts'=>$posts]);
    }

    public function postHamburgerInformation() {

        return view('form');
    }

    public function UpHamburgerDate(Request $request) {

        $posts = DB::select('select * from posts');

        // バリデーション
        $validatedData = [
            'name'=>'required|max:255',
            'price'=>'required',
            'detail'=>'required|max:500',
            'store_name'=>'required|max:255',
            'img_path' => 'file|mimes:jpeg,png,jpg,bmb|max:2048',
            'city'=>'required',
        ];

        $this->validate($request, $validatedData);
        // ここまで

        $filename='';
        if($request->hasFile('image')) {
            $filename=$request->file('image')->store('/img',['disk'=>'public']);
        }

        $item = [
            'user_id'=>Auth::id(),
            'name'=>$request->name,
            'price'=>$request->price,
            'detail'=>$request->detail,
            'img_path'=>$filename,
            'store_name'=>$request->store_name,
            'city'=>$request->city,
            'created_at'=>now()
        ];

        DB::insert('insert into posts(user_id,name,price,detail,img_path,store_name,city,created_at)
        values(:user_id,:name,:price,:detail,:img_path,:store_name,:city,:created_at)',$item);

        return redirect('/');
    }


// ＝＝＝＝投稿詳細画面表示＝＝＝＝＝
    public function show(Request $request,$id,Post $post) {

        $authUser = Auth::user();
        $post = Post::find($id);

        $like = $post->likes()->where('user_id', Auth::id())->first();

        return view ('show',[
            'authUser' => $authUser,
            'post' =>$post,
            'like' => $like,
        ]);
    }




// ＝＝＝＝いいねをつける＝＝＝＝
    public function like(Request $request, $postId) {

        Like::create(
            array(
            'user_id' => Auth::id(),
            'post_id' => $postId
            )
        );

        $post = Post::findOrFail($postId);

        return redirect()
            ->action('hamburgerController@show', $post->id);
    }



// ＝＝＝＝いいねを消す＝＝＝＝
    public function unlike($postId, $likeId) {

        try{
            $post = Post::findOrFail($postId);

            Like::findOrFail($likeId)->delete();
            return redirect()
            ->route('hamburger_show', $postId);

        }catch(Exception $e){
            dd($e);
        }
    }


// ＝＝＝＝記事編集＝＝＝＝
    public function edit(Request $request,$id,Post $post) {

        $post = Post::find($id);

        if(is_null($post)) {
            return redirect(route('hamburger_show'));
        }

        return view('edit',['post'=>$post]);
    }


// ＝＝＝＝編集して記事の更新＝＝＝＝
    public function update(Request $request) {

        $filename='';

        if($request->hasFile('image')) {

            $filename=$request->file('image')->store('/img',['disk'=>'public']);
        }

        $post = Post::find($request->id);
        $post->user_id = Auth::id();
        $post->name = $request->name;
        $post->price = $request->price;
        $post->detail = $request->detail;
        if($filename) {
            $post->img_path =$filename;
        }
        $post->timestamps = false;
        $post->save();
        return redirect('/');
    }

// ＝＝＝＝記事の削除＝＝＝＝
    public function destroy(Request $request,$id,Post $post) {

        try {
            Post::destroy($id);
        } catch(\Throwable $e) {
            abort(500);
        }

        return redirect('/');

    }

    // public function delete (Request $request) {
    //     $post = Post::find($request->id);
    //     dd($post);
    //     Post::find($id)->delete();
    //     return redirect('/');
    // }

}


