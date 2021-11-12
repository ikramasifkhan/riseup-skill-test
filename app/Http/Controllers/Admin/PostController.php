<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\AdminResouce;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Repository\Interfaces\FileInterface;
use App\Repository\Interfaces\PostInterface;
use App\Service\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request, FileUploadService $service)
    {
        //return auth('admin')->user();
        try {
            DB::beginTransaction();
            $data = $request->except('thumbnail');
            $data['admin_id'] = auth('admin-api')->user()->id;
            $post = $this->post->createPost($data);
            if ($request->hasFile('thumbnail')) {
                $service->addFile('post', $post->id);
            }
            $postData = new PostResource($post);
            DB::commit();
            return response()->sendSuccess($postData, 'Post Create');
        } catch (\Exception $exception) {
            DB::rollBack();
            return \response()->sendErrorWithException($exception, 'OPPS! Something Wrong', 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post, FileUploadService $service)
    {
        try {
            DB::beginTransaction();
            $this->post->udpdatePost($request->except('thumbnail'), $post);
            if ($request->hasFile('thumbnail')) {
                $file = $this->file->getFileData(['post_id'=>$post->id]);
                if(isset($file)){
                    $service->updateFile($file, 'post');
                }else{
                    $service->addFile('post', $post->id);
                }

            }
            $postData = new PostResource($post);
            DB::commit();
            return response()->sendSuccess($postData, 'Post Updated Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return \response()->sendErrorWithException($exception, 'OPPS! Something Wrong', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        try {
            DB::beginTransaction();
            $this->post->deletePost($post);
            $this->file->deleteFile(['post_id'=>$post->id]);
            DB::commit();
            return response()->sendSuccess('Post Deleted Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return \response()->sendErrorWithException($exception, 'OPPS! Something Wrong', 500);
        }
    }
}
