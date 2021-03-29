<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\Contracts\PostServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{

    /**
     * @var PostServiceInterface
     */
    protected $postService;

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display List of users posts
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $posts = $this->postService->list(auth()->user());

        return $this->respondWithData(new PostCollection($posts));
    }

    /**
     * @param CreatePostRequest $request
     * @return mixed
     */
    public function store(CreatePostRequest $request)
    {
        $post = $this->postService->store(auth()->user(), $request->validated());

        return $this->respondCreatedWithPayload(
            new PostResource($post),
            "Post created successfully."
        );
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($id)
    {
        // $post = Post::find($id);

        $post = $this->postService->find($id);

        $this->authorize('view', $post);

        return $this->respondWithData(new PostResource($post));
    }

    /**
     * @param UpdatePostRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdatePostRequest $request, $id)
    {



        // $post = Post::find($id);

        // if (!Gate::allows('update', $post)) {
        // if (auth()->user()->cannot('update', $post)) {
        // if (auth()->user()->cannot('update', $post)) {
        //     return $this->respondForbidden("You are not authorized to perform this action");
        // }

        // $this->authorize('update', $post);

        // $post->update(
        //     [
        //         'title' => $request->title,
        //         'description' => $request->description
        //     ]
        // );

        $this->postService->update($id, $request->validated());

        return $this->respondWithMessage('Post updated successfully.');
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($id)
    {
        $post = $this->postService->find($id);

        $this->authorize('delete', $post);

        $this->postService->delete($id);

        return $this->respondNoContent("Post Deleted Successfully.");
    }
}
