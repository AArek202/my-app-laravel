<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\PostResource;

class PostApiController extends Controller
{

    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(10);

        return PostResource::collection($posts);
    }

    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'title' => 'required|min:3',
                'content' => 'required|min:3',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            ],
            [
                'image.image' => 'The file must be an image.',
                'image.mimes' => 'Allowed formats: jpg, jpeg, png, gif.',
                'image.max' => 'Image size must not exceed 2MB.',
            ]
        );

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $data['user_id'] = $request->user()->id;

        $post = Post::create($data);

        return response()->json([
            'message' => 'Post created successfully',
            'data' => $post
        ], 201);
    }

    public function show(Post $post)
    {
        $post->load('user');

        return new PostResource($post);
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:3',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $data['user_id'] = $request->user()->id;

        if ($request->hasFile('image')) {

            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }

            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($data);

        return response()->json([
            'message' => 'Post updated successfully',
            'data' => $post
        ], 200);
    }

    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return response()->json([
            'message' => 'Post deleted successfully'
        ], 200);
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();

        return response()->json([
            'message' => 'Post restored successfully',
            'data' => $post
        ], 200);
    }

    public function forceDelete($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $post->forceDelete();

        return response()->json([
            'message' => 'Post permanently deleted'
        ], 200);
    }
}
