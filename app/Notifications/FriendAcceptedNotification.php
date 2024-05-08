<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class FriendAcceptedNotification extends Notification
{
    use Queueable;
    protected $acceptedUser;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $acceptedUser)
    {
        $this->acceptedUser = $acceptedUser;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Friend Request Accepted')
            ->line('Your friend request has been accepted by ')
            ->action('View your new friend', route('user.friends'))
            ->line('Thank you for using our application!')
            ->view('notifications.friendAcceptedNotification', [
                'acceptedUser' => $this->acceptedUser,
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'user_id' => $this->acceptedUser->id,
            'message' => 'Your friend request has been accepted by '.$this->acceptedUser->name.'.',
            'action_url' => route('profile.show', $this->acceptedUser->profile),
        ];
    }
}
