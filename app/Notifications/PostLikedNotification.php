<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostLikedNotification extends Notification
{
    use Queueable;

    protected $liker;
    protected $post;

    /**
     * Create a new notification instance.
     */
    public function __construct($liker,$post)
    {
        $this->liker = $liker;
        $this->post = $post;

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
                    ->subject('Your post has been liked')
                    ->greeting('Hello!')
                    ->line('Your post has been liked by '.$this->liker->name.'.')
                    ->action('View Post', url('/posts/'.$this->post->id))
                    ->line('Thank you for using our application!')
                    ->view('notifications.likedNotification', [
                        'liker' => $this->liker,
                        'post' => $this->post,
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
            'liker_id' => $this->liker->id,
            'liker_name' => $this->liker->name,
            'post_id' => $notifiable->id,
            'post_title' => $notifiable->title,
        ];
    }
}
