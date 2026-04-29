<x-app-layout>
    <div class="max-w-2xl mx-auto px-4">
        <h1 class="text-3xl font-bold mb-6">Create Post</h1>

        <form method="POST" action="{{ route('posts.store') }}" class="space-y-5" enctype="multipart/form-data">
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

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Post Image
                </label>

                <input
                    type="file"
                    name="image"
                    class="block w-full text-sm text-gray-700 
               file:mr-4 file:py-2 file:px-4
               file:rounded-lg file:border-0
               file:text-sm file:font-semibold
               file:bg-green-500 file:text-white
               hover:file:bg-green-600
               cursor-pointer
               border border-gray-300 rounded-lg
               focus:outline-none focus:ring-2 focus:ring-green-500">

                @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button class="w-full bg-green-500 text-white py-3 rounded-lg">
                Save
            </button>

            @if ($errors->any())
            <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

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
</x-app-layout>