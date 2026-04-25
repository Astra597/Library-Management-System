<!DOCTYPE html>
<html>
<head><title>Posts</title></head>
<body>
<h1>All Posts</h1>

<a href="/posts/create">Add New Post</a>
<hr>

@if($posts->count())
    @foreach($posts as $post)
        <div style="border:1px solid #000; padding:10px; margin:10px 0;">
            <h3>{{ $post->title }}</h3>

            <a href="/posts/{{ $post->id }}">Show</a> |
            <a href="/posts/{{ $post->id }}/edit">Edit</a> |

            <form action="/posts/{{ $post->id }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </div>
    @endforeach
@else
    <p>No posts found.</p>
@endif

</body>
</html>