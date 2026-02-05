<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $posts = Post::active()
            ->with('user')
            ->paginate(20);

        return response()->json($posts);
    }

    public function show($id)
    {
        $post = Post::active()
            ->with('user')
            ->findOrFail($id);

        return response()->json($post);
    }

    public function store(StorePostRequest $request)
    {
        $post = $request->user()
            ->posts()
            ->create($request->validated());

        return response()->json([
            'data' => $post,
        ], 201);
    }

    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::findOrFail($id);

        $this->authorize('update', $post);

        $post->update($request->validated());

        return response()->json([
            'data' => $post,
        ]);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $this->authorize('delete', $post);

        $post->delete();

        return response()->json([
            'message' => 'Post deleted',
        ]);
    }

    public function create()
    {
        return 'posts.create';
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        $this->authorize('update', $post);

        return 'posts.edit';
    }
}
