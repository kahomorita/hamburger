<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use kanazaca\CounterCache\CounterCache;
use App\Http\Controllers\hamburgerController;

class Like extends Model
{
    use CounterCache;

    public $counterCacheOptions = [
        'Post' => [
            'field' => 'likes_count',
            'foreignKey' => 'post_id'
        ]
    ];

    protected $fillable = ['user_id', 'post_id'];

    public function Post()
    {
      return $this->belongsTo('App\Models\Post');
    }

    public function User()
    {
      return $this->belongsTo(User::class);
    }
}
