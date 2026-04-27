@foreach($posts as $post)
<div>
    <h2>{{ $post['title'] }}</h2>

    <a href="{{ route('posts.edit', $post['id']) }}">Edit</a>


    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
</div>
@endforeach