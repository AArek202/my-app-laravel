<h1>Create Post</h1>

<form method="POST" action="{{ route('posts.store') }}">
    @csrf
    <input type="text" placeholder="Title" name="title">
    <textarea placeholder="Content" name="content"></textarea>
    <button type="submit">Save</button>
</form>