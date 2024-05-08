<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\ChMessage ;

class NewChatMessageNotification extends Notification
{
    use Queueable;
    public $message;

    /**
     * Create a new notification instance.
     */
    public function __construct(ChMessage $message)
    {
        $this->message = $message;
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
        ->subject('New message')
        ->greeting('Hello')
        ->line('You have received new message :')
        ->line($this->message->content)
        ->action('View the  message', url('/messages'))
        ->line('Thank you for using our application');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
                'type' => 'new_chat_message',
                'message_id' => $this->message->id,
                'content' => $this->message->content,
                // Autres données que vous souhaitez stocker dans la notification

        ];
    }
}
