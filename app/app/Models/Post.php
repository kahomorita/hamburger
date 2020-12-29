<?php

namespace App\Models;  //名前空間

use Illuminate\Database\Eloquent\Model;
use App\Models\Like;
use App\Models\User;

class Post extends Model
{
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    //メソッド名はローワーキャメルケース！
    public function likeBy()
    {
        return Like::where('user_id', \Auth::id())->get();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

// ＝＝＝＝city名取得＝＝＝＝
    public function getCityNameAttribute()
    {
        return config('city.'.$this->city);
    }

}
