// LOOK HERE


@foreach($posts as $post)
<div>
    <h2>{{ $post['title'] }}</h2>

    <a href="{{ route('posts.edit', $post['id']) }}">Edit</a>

    <form method="POST" action="{{ route('posts.destroy', $post['id']) }}">
        @csrf
        <button type="submit">Delete</button>
    </form>
</div>
@endforeach