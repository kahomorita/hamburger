<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
 * Determine whether the user can update the article.
 *
 * @param  \App\Models\User  $user
 * @param  \App\Models\Post  $post
 * @return mixed
 */
public function edit(User $user, Post $post)
    {
        return $user->id == $post->user_id;
    }
}
