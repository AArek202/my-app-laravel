@if($post)
<form method="POST" action="{{ route('posts.update', $post['id']) }}">
    @csrf

    <input type="text" name="title" value="{{ $post['title'] }}">
    <textarea name="content">{{ $post['content'] }}</textarea>

    <button type="submit">Update</button>
</form>
@else
<p>Post not found</p>
@endif