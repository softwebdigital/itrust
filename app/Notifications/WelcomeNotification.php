<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class WelcomeNotification extends Notification
{
    use Queueable;
    private $welcomeData;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($welcomeData)
    {
        $this->welcomeData = $welcomeData;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Welcome to '.env('APP_NAME'))
            ->greeting('Hello '.$this->welcomeData['name'])
            ->line(new HtmlString($this->welcomeData['message']))
            ->action('Login Now', url('/login'))
            ->line('Thank you for choosing us!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable): array
    {
        return [
            'title' => $this->welcomeData['title'],
            'message' => $this->welcomeData['message'],
        ];
    }
}
