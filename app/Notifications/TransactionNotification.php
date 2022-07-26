<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class TransactionNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $data;
    public function __construct($data)
    {
        $this->data = $data;
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
     */
    public function toMail($notifiable): MailMessage
    {
        if (array_key_exists('btc_wallet', $this->data)) {
            return (new MailMessage)
                ->subject($this->data['subject'])
                ->greeting('Hello ' . $this->data['name'])
                ->line(new HtmlString($this->data['body']))
                ->line('Wallet Address : ' . $this->data['btc_wallet'])
                ->line('Thank you for choosing us!');
        } else {
            return (new MailMessage)
                ->subject($this->data['subject'])
                ->greeting('Hello ' . $this->data['name'])
                ->line(new HtmlString($this->data['body']))
                ->line('Thank you for choosing us!');
        }

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
            'title' => $this->data['subject'],
            'message' => $this->data['body'],
        ];
    }
}
