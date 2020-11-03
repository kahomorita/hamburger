<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index()
   {
       return view('form');
   }

   public function store(PostFormRequest $request)
    {
        $filename=$request->imgpath->store('/img',['disk'=>'public']);

        //redirect...あるページから別のページへ移動する。
        //with('変数名','値')
        // return redirect('form')->with('success','投稿しました');
    }

}
