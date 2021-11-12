<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Repository\Interfaces\FileInterface;
use App\Repository\Interfaces\PostInterface;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $post;
    protected $file;

    public function __construct(PostInterface $post, FileInterface $file)
    {
        $this->post = $post;
        $this->file = $file;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = PostResource::collection($this->post->postList());
            return response()->sendSuccess($data, 'Post List');
        } catch (\Exception $exception) {
            return \response()->sendErrorWithException($exception, 'OPPS! Something Wrong', 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        try {
            $data = new PostResource($this->post->postDetails($post->id));
            return response()->sendSuccess($data, 'Post Details');
        } catch (\Exception $exception) {
            return \response()->sendErrorWithException($exception, 'OPPS! Something Wrong', 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
