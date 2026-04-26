// LOOK HERE

@if($post)
<h1>{{ $post['title'] }}</h1>
<p>{{ $post['content'] }}</p>
@else
<p>Post not found</p>
@endif