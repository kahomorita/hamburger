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

     //何をクリエイトするかわからないのでわかりやすいメソッド名を！
    public function create() {

        return view('form');
    }

    public function store(Request $request) {

        $posts = DB::select('select * from posts');

        // バリデーション
        $validatedData = [
            'name'=>'required|max:20',
            'price'=>'required',
            'detail'=>'required|max:500',
            'imgpath' => 'file|mimes:jpeg,png,jpg,bmb|max:2048',
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
            'city'=>$request->city,
            'created_at'=>now()
        ];

        DB::insert('insert into posts(user_id,name,price,detail,imgpath,city,created_at)
        values(:user_id,:name,:price,:detail,:imgpath,:city,:created_at)',$item);

        return redirect('/');
    }


// ＝＝＝＝投稿詳細画面表示＝＝＝＝＝
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
            // \Session::flash('err_msg','データがありません。');
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

        //下のsaveまでの内容この二行でできるかもフォームのnameとかをDBのカラムに一致させておけばこんな感じですっきりいけます！
        //filenameは一手間いるかな？
        //        $update_data = $request->all();
        //        $post = Post::find($request->id)->update($update_data);
        $post = Post::find($request->id);
        $post->user_id = Auth::id();
        $post->name = $request->name;
        $post->price = $request->price;
        $post->detail = $request->detail;
        if($filename) {
            $post->imgpath =$filename;
        }
        $post->timestamps = false;
        $post->save();
        return redirect('/');

        //ここから下は不要ですね！
        // \Session::flash('err_msg','投稿しました！');
        return redirect('/');
    }

// ＝＝＝＝記事の削除＝＝＝＝
    public function destroy(Request $request,$id,Post $post) {

        try {
            //これは物理削除なので、論理削除ってのも覚えておくといいかも！laravel softdeleteで調べるとで的mさう！
            Post::destroy($id);
        } catch(\Throwable $e) {
            abort(500);
        }

        return redirect('/');

    }

}


