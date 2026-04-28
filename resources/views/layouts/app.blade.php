<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Posts App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('posts.index') }}" class="text-xl font-bold text-gray-800">
                Posts App
            </a>

            <div class="space-x-4">
                <a href="{{ route('posts.index') }}"
                    class="text-gray-600 hover:text-blue-500">
                    Home
                </a>

                <a href="{{ route('posts.create') }}"
                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                    Create Post
                </a>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    <div class="max-w-4xl mx-auto mt-6 px-4">
        @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">
            {{ session('success') }}
        </div>
        @endif
    </div>

    <!-- Page Content -->
    <main class="py-6">
        @yield('content')
    </main>

</body>

</html>