<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::whereUserId(auth()->id())
            ->paginate(config('constants.app.pagination_size'));

        return $this->respondWithData(new PostCollection($posts));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $post = auth()->user()->posts()->create(
            $request->validated()
        );

        return $this->respondCreatedWithPayload(
            new PostResource($post),
            "Post created successfully."
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        $this->authorize('view', $post);

        return $this->respondWithData(new PostResource($post));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {



        $post = Post::find($id);

        // if (!Gate::allows('update', $post)) {
        // if (auth()->user()->cannot('update', $post)) {
        // if (auth()->user()->cannot('update', $post)) {
        //     return $this->respondForbidden("You are not authorized to perform this action");
        // }

        // $this->authorize('update', $post);

        $post->update(
            [
                'title' => $request->title,
                'description' => $request->description
            ]
        );
        return $this->respondWithMessage('Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        $this->authorize('delete', $post);

        $post->delete();

        return $this->respondNoContent("Post Deleted Successfully.");
    }
}
