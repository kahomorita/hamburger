<?php

namespace App\Models;  //名前空間

use Illuminate\Database\Eloquent\Model;
use App\Models\Like;

class Post extends Model
{
    public function likes()
    {
      return $this->hasMany('App\Models\Like');
    }

    public function like_by()
    {
      return Like::where('user_id', \Auth::user()->id)->first();
    }
}
