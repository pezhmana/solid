<?php

namespace App\Services;

class MediaClass
{
    public function addProfileMedia($user, $profile)
    {
        $user->addMediaFromRequest($profile)->toMediaCollection('profile');
    }

    public function getAllPost($userPosts)
    {
        $allMediaUrls = [];

        foreach ($userPosts as $post) {
            $mediaItems = $post->getMedia('post');
            foreach ($mediaItems as $media) {
                $allMediaUrls[] = $media->getUrl();
            }
        }

        return $allMediaUrls;
    }

}
