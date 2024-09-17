<?php

namespace App\Services;

use App\Models\Follow;
use App\Models\User;
class FollowClass
{

    public function send($user , $following){
        $following = (new UserClass)->find($following);
        if($following->status == 'close'){
            $send = Follow::create([
                'follower'=>$user->id,
                'following'=>$following->id,
                'type'=>'request'
            ]);
        }else{
            $send = Follow::create([
                'follower'=>$user->id,
                'following'=>$following->id,
                'type'=>'accept'
            ]);
        }
        return $send;
    }

    public function indexRequest($user)
    {
        $id=[];
        foreach ($user->followers as $following) {
            $id[] = $following->follower;
        }
        $requests =(new UserClass)->shortProfile($id);
        return $requests;
    }
}
