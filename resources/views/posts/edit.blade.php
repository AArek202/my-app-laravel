@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4">
    @if($post)

    <h1 class="text-3xl font-bold mb-6">Edit Post</h1>

    <form method="POST" action="{{ route('posts.update', $post['id']) }}" class="space-y-5">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div>
            <input type="text" name="title"
                value="{{ old('title', $post['title']) }}"
                class="w-full p-3 border rounded-lg">

            @error('title')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Content -->
        <div>
            <textarea name="content" rows="5"
                class="w-full p-3 border rounded-lg">{{ old('content', $post['content']) }}</textarea>

            @error('content')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button class="w-full bg-yellow-500 text-white py-3 rounded-lg">
            Update
        </button>

        <select name="user_id" class="w-full p-3 border rounded-lg">
            <option value="">Select User</option>
            @foreach($users as $user)
            <option value="{{ $user->id }}"
                {{ old('user_id', $post->user_id ?? '') == $user->id ? 'selected' : '' }}>
                {{ $user->name }}
            </option>
            @endforeach
        </select>

        @error('user_id')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </form>

    @else
    <p class="text-red-500 text-center">Post not found</p>
    @endif
</div>
@endsection