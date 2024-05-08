<div>
    <h3>New Like on Your Post</h3>
    <p>{{ $liker->name }} has liked your post.</p>
    <p>Click the button below to view the post:</p>
    <a href="{{ url('/posts/' . $post->id) }}" target="_blank" style="display: inline-block; padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none;">
        View Post
    </a>
    <p>Thank you for using our application!</p>
</div>
