@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4">
    <h1 class="text-3xl font-bold mb-6">Create Post</h1>

    <form method="POST" action="{{ route('posts.store') }}" class="space-y-5">
        @csrf

        <!-- Title -->
        <div>
            <input type="text" name="title" placeholder="Title"
                value="{{ old('title') }}"
                class="w-full p-3 border rounded-lg">

            @error('title')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Content -->
        <div>
            <textarea name="content" rows="5"
                class="w-full p-3 border rounded-lg"
                placeholder="Content">{{ old('content') }}</textarea>

            @error('content')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button class="w-full bg-green-500 text-white py-3 rounded-lg">
            Save
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
</div>
@endsection