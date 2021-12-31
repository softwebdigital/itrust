<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class SendActionWithdrawalNotification extends Notification
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
     * @return MailMessage
     */
    public function toMail($notifiable): MailMessage
    {



            if($this->data['action'] == 'approved'){
                if($this->data['type'] == 'bank'){
                    return (new MailMessage)
                    ->subject($this->data['subject'])
                    ->greeting('Hello '.$this->data['name'])
                    ->line(new HtmlString($this->data['body']))
                    ->line('Bank Name : '.$this->data['bank'])
                    ->line('Account Name : '.$this->data['acct_name'])
                    ->line('Account Number : '.$this->data['number'])
                    ->line('Thank you for choosing Itrust!');
                }else{
                    return (new MailMessage)
                    ->subject($this->data['subject'])
                    ->greeting('Hello '.$this->data['name'])
                    ->line(new HtmlString($this->data['body']))
                    ->line('Wallet Address : '.$this->data['btc_wallet'])
                    ->line('Thank you for choosing Itrust!');
                }
            }else{
                if($this->data['type'] == 'bank'){
                    return (new MailMessage)
                    ->subject($this->data['subject'])
                    ->greeting('Hello '.$this->data['name'])
                    ->line(new HtmlString($this->data['body']))
                    ->line('Thank you for choosing Itrust!');
                }else{
                    return (new MailMessage)
                    ->subject($this->data['subject'])
                    ->greeting('Hello '.$this->data['name'])
                    ->line(new HtmlString($this->data['body']))
                    ->line('Thank you for choosing Itrust!');
                }
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
