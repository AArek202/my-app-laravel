<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::withTrashed()->with('user')->latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('posts.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:3',
            'user_id' => 'required|exists:users,id',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            ],
            [
                'image.image' => 'The file must be an image.',
                'image.mimes' => 'Allowed formats: jpg, jpeg, png, gif.',
                'image.max' => 'Image size must not exceed 2MB.',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $data['user_id'] = Auth::id();

        Post::create($data);

        return redirect()->route('posts.index')->with('success', 'Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $users = User::all();
        return view('posts.edit', compact('post', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:3',
            'user_id' => 'required|exists:users,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {

            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }

            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($data);

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index');
    }

    public function restore($id)
    {
        Post::withTrashed()->find($id)->restore();

        return back();
    }

    public function forceDelete($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $post->forceDelete();

        return back()->with('success', 'Post permanently deleted');
    }
}
