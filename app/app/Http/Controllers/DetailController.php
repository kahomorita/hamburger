<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index() //追加
   {
       //このコントローラまだ使ってないんかな？
       return view('detail',compact('stocks'));
       //↓returnの後にコードは絶対こないです！！！
       $detail = Detail::all();
   }
}
