<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index()
   {
       return view('form');
   }

   //storeは登録とかの意味になるんだけど、、、、正直わかりにくいのでちゃんと意味のある名前をつけることをお勧めします！
   public function store(PostFormRequest $request)
    {
        //['disk'=>'public']これ怪しいですね。publicに画像を保存するのは普通あんまりしないです！ここに入れちゃうと外部からその画像とかが見れちゃうので！
        //どういう時に問題かというとTwitterの鍵付きユーザーが投稿した画像も見れちゃってる状態ってことです！
        $filename=$request->imgpath->store('/img',['disk'=>'public']);

        //redirect...あるページから別のページへ移動する。
        //with('変数名','値')
        // return redirect('form')->with('success','投稿しました');
    }

}
