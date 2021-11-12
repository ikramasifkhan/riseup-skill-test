<?php

namespace App\Repository\Interfaces;

interface PostInterface
{
    public function postList();
    public function postDetails($postId);
    public function createPost($requestData);
    public function udpdatePost($requestData, $postData);
    public function deletePost($postData);
}
