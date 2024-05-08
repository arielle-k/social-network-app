<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AddCommentNotification extends Notification
{
    use Queueable;
    protected  $comment;

    /**
     * Create a new notification instance.
     */
    public function __construct($comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {

        return ['mail', 'database'];

    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Comment Notification')
            ->greeting('Hello!')
            ->line('You have a new comment on your post.')
            ->action('View Comment', url('/posts/' . $this->comment->post->id))
            ->line('Thank you for using our application!')
            ->view('notifications.commentNotification', [
                'comment' => $this->comment,
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
            'type' => 'new_comment',
            'comment_id' => $this->comment->id,
            'post_id' => $this->comment->post->id,
            'user_id' => $this->comment->user->id,
        ];
    }
}
