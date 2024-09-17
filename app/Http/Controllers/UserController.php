<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginRequest;
use App\Services\MediaClass;
use App\Services\PostClass;
use App\Services\UserClass;


class UserController extends Controller
{
    protected $userClass;
    protected $mediaClass;

    public function __construct(UserClass $userClass,MediaClass $mediaClass,PostClass $PostClass)
    {
        $this->userClass = $userClass;
        $this->mediaClass = $mediaClass;
        $this->PostClass = $PostClass;
    }

    public function createUser(CreateUserRequest $request){
        $user = $this->userClass->createUser($request->validated());
        if ($request->profile) {
            $this->mediaClass->addProfileMedia($user, $request->profile);
        }
        return response()->json($user);
    }

    public function login(LoginRequest $request)
    {
        $token = $this->userClass->login($request->validated());
        return response()->json($token);

    }

    public function index($username){
        $user =$this->userClass->indexUser($username);
        $posts =$user->posts()->first();
        $posts = $this->PostClass->UserPost($username);
        return response()->json([$user,$posts]);
    }


}
