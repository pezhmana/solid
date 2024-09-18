<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class EnsureFollowing
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $username = $request->route('username');
        $follower = User::where('username', $username)->first();

        if (!$follower) {
            return response('User not found');
        }

        $status = $follower->status;
        $follow = $user->following()->where('type', 'accept')->where('following', $follower->id);

        if ($status == 'open') {
            return $next($request);
        } else {
            if ($follow->exists()) {
                return $next($request);
            } else {
                return response('Not following');
            }
        }
    }
}
