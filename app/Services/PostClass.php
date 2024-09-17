<?php

namespace App\Services;

use App\Models\Post;

class PostClass
{
    public function create(array $data,$user)
    {

        $post =$user->posts()->create($data);
        return $post;
    }
}
