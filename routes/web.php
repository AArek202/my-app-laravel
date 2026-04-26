<?php
// LOOK HERE

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/posts', function () {
    if (!session()->has('posts')) {
        session([
            'posts' => [
                1 => ['id' => 1, 'title' => 'First Post', 'content' => 'Content 1'],
                2 => ['id' => 2, 'title' => 'Second Post', 'content' => 'Content 2'],
            ]
        ]);
    }

    $posts = session('posts');

    return view('posts.index', compact('posts'));
})->name('posts.index');

Route::get('/posts/create', function () {
    return view('posts.create');
})->name('posts.create');

Route::post('/posts', function (Request $request) {
    return $request->all();
});

Route::get('/posts/show', function (Request $request) {
    $posts = [
        1 => ['title' => 'First Post', 'content' => 'Content 1'],
        2 => ['title' => 'Second Post', 'content' => 'Content 2'],
        3 => ['title' => 'Third Post', 'content' => 'Content 3'],
    ];

    $post = $posts[$request->id] ?? null;

    return view('posts.show', compact('post'));
});

Route::get('/posts/edit/{id}', function ($id) {
    $posts = session('posts');
    $post = $posts[$id] ?? null;

    return view('posts.edit', compact('post'));
})->name('posts.edit');

Route::post('/posts/update/{id}', function (Request $request, $id) {
    $posts = session('posts');

    if (isset($posts[$id])) {
        $posts[$id]['title'] = $request->title;
        $posts[$id]['content'] = $request->content;

        session(['posts' => $posts]);
    }

    return redirect()->route('posts.index');
})->name('posts.update');

Route::post('/posts/delete/{id}', function ($id) {
    $posts = session('posts');

    unset($posts[$id]);

    session(['posts' => $posts]);

    return redirect()->route('posts.index');
})->name('posts.destroy');
