<!DOCTYPE html>
<html>

<head>
    <title>Edit Post</title>
</head>

<body>
    <h1>Edit Post</h1>

    <form action="/posts/{{ $post->id }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Title</label><br>
            <input type="text" name="title" value="{{ $post->title }}">
        </div>
        <div>
            <label>Content</label><br>
            <textarea name="content">{{ $post->content }}</textarea>
        </div>

        <button type="submit">Update</button>
    </form>

</body>

</html>