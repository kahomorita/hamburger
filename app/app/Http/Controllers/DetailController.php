<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index() //追加
   {
       return view('detail',compact('stocks'));
       $detail = Detail::all();
   }
}
