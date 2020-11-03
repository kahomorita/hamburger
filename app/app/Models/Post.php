<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function likes()
    {
      return $this->hasMany('App\Models\Like');
    }

    public function like_by()
    {
ここいきなりLike使ってるんで、一応上で他のファイルみたいにLikeモデルをuseで宣言してもらっていいですか？
      return Like::where('user_id', \Auth::user()->id)->first();
    }
}
