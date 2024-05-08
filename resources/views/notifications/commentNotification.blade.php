<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Comment</title>
</head>
<body>
    <h1>New Comment</h1>

    <p>Hello!</p>

    <p>You have a new comment on your post.</p>

    <p>Click the button below to view the comment:</p>

    <a href="{{ url('/posts/'.$comment->post_id) }}" target="_blank" style="display: inline-block; padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none;">
        View Comment
    </a>

    <p>Thank you for using our application!</p>
</body>
</html>
