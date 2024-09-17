<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\CreateUserRequest;
use App\Services\PostClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct(PostClass $PostClass)
    {
        $this->PostClass = $PostClass;
    }

    public function create(CreatePostRequest $request)
    {
        $user = Auth::user();
        $post = $this->PostClass->create($request->validated() , $user);
        $post->addMediaFromRequest('media')->toMediaCollection('post');
        return response()->json($post);
    }
}
