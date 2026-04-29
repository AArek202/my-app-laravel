<x-app-layout>
    <div class="max-w-2xl mx-auto py-10">
        @if($post)
        <div class="bg-white shadow-md rounded-2xl p-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">
                {{ $post['title'] }}
            </h1>

            <!-- User Posted -->
            <p class="text-sm text-gray-600 mb-2">
                By: {{ $post->user->name ?? 'Unknown' }}
            </p>

            <p class="text-gray-600 leading-relaxed">
                {{ $post['content'] }}
            </p>

            @if($post->image)
            <img src="{{ asset('storage/' . $post->image) }}"
                class="w-full object-cover rounded-lg mb-3">
            @endif
        </div>

        @else
        <p class="text-center text-red-500 font-semibold">
            Post not found
        </p>
        @endif
    </div>
</x-app-layout>