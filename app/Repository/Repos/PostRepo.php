<?php

namespace App\Repository\Repos;

use App\Models\Post;
use App\Repository\Interfaces\PostInterface;

class PostRepo implements PostInterface
{

    public function postList()
    {
        return Post::latest('id')->get();
    }

    public function postDetails($postId)
    {
        return Post::with('admin', 'file')->findOrFail($postId);
    }

    public function createPost($requestData)
    {
        return Post::create($requestData);
    }

    public function udpdatePost($requestData, $postData)
    {
        return $postData->update($requestData);
    }

    public function deletePost($postData)
    {
        return $postData->delete();
    }
}
