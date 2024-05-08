<div>
    <h3>New Friend Request</h3>
    <p>You have a new friend request from {{ $user->name }}.</p>
    <p>Click the button below to view their profile:</p>
        <a href="{{ url('/profile/'.$user->profile->id) }}" target="_blank" style="display: inline-block; padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none;">
            View profile
        </a>
        <p><a href="{{ url('/friends/' . $user->profile->id . '/follow-back') }}" target="_blank" style="display: inline-block; padding: 10px 20px; background-color: #af4ca7; color: rgb(236, 222, 222); text-decoration: none;">Follow Back</a></p>
</div>
