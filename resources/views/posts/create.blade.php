<!DOCTYPE html>
<html>

<head>
    <title>Create Post</title>
</head>

<body>
    <h1>Create Post</h1>

    <form action="/posts" method="POST">
        @csrf
        <div>
            <label>Title</label><br>
            <input type="text" name="title">
        </div>
        <div>
            <label>Content</label><br>
            <textarea name="content"></textarea>
        </div>
        <button type="submit">Save</button>
    </form>

</body>

</html>