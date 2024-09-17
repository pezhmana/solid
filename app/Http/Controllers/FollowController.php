<?php

namespace App\Http\Controllers;

use App\Services\FollowClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    protected $followClass;
    public function __construct(FollowClass $followClass)
    {
        $this->FollowClass = $followClass;
    }
    public function send($following)
    {
        $user = Auth::user();
        $res = $this->FollowClass->send($user , $following);
        return response()->json($res);
    }

    public function indexRequest()
    {
        $user = Auth::user();
        $request = $this->FollowClass->indexRequest($user);
        return response()->json($request);

    }

}
