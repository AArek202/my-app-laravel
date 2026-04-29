<x-app-layout>


    <div class="max-w-3xl mx-auto px-4 space-y-6">
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Posts
                </h2>

                <a href="{{ route('posts.create') }}"
                    class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                    + Create Post
                </a>
            </div>
        </x-slot>

        @foreach($posts as $post)
        <div class="bg-white shadow-md rounded-2xl p-6 border mt-5">

            <a href="{{ route('posts.show', $post->id) }}">
                <h2 class="text-2xl font-semibold text-gray-800 mb-3">
                    {{ $post->title }}
                </h2>
            </a>

            <!-- User Posted -->
            <p class="text-sm text-gray-600 mb-2">
                By: {{ $post->user->name ?? 'Unknown' }}
            </p>

            <!-- Created At -->
            <p class="text-sm text-gray-500 mb-3">
                {{ $post->created_at->diffForHumans() }}
            </p>


            <div class="flex gap-4">

                @if(!$post->trashed())
                <a href="{{ route('posts.edit', $post->id) }}"
                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                    Edit
                </a>

                <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                    onsubmit="return confirm('Delete this post?')">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                        Delete
                    </button>
                </form>
                @else
                <form action="{{ route('posts.restore', $post->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
                        Restore
                    </button>
                </form>

                <form action="{{ route('posts.forceDelete', $post->id) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to permanently delete this post?')">
                    @csrf
                    @method('DELETE')

                    <button class="bg-red-600 text-white px-3 py-1 rounded">
                        Force Delete
                    </button>
                </form>
                @endif

            </div>
        </div>
        @endforeach
        <div class="mt-6">
            {{ $posts->links() }}
        </div>

    </div>

</x-app-layout>