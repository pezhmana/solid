<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserClass
{
    public function createUser(array $data){
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }

    public function indexUser($username){
        $user =User::where('username',$username);
        if(!$user->exists()){
            $user = 'user not found';
        }else{
            $user =$user->first(['username','biography','status']);
        }
        return $user;
    }

    public function followingCount($username)
    {
        $count = $this->find($username)->followers()->where('type','accept')->count();
        return $count;
    }

    public function followersCount($username)
    {
        $count = $this->find($username)->following()->where('type','accept')->count();
        return $count;
    }

    public function login(array $data)
    {
        $user = User::where('username',$data['username']);
        if($user->exists()){
            if(!Hash::check($data['password'],$user->first()->password)){
                $token = 'password is not correct';
            }else{
                $token = $user->first()->createToken('token')->plainTextToken;
            }
        }else{
            $token = 'user not found';
        }
        return $token;
    }

    public function find($username){
        $user = User::where('username',$username)->first();
        return $user;
    }

    public function search($id)
    {
        $user = User::find($id);
        return $user;
    }

    public function shortProfile($id)
    {
        $user = $this->search($id)->select(['id','username']);
        return $user;
    }
}
