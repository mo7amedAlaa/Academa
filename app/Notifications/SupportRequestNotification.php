<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class SupportRequestNotification extends Notification
{
    public $data;

    // Constructor to accept the data passed to the notification
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
    public function via($notifiable)
    {
        return ['mail', 'database']; // Notification will use mail and database
    }

    /**
     * Send a mail notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('You have received a new support request.')
            ->line('Name: ' . $this->data['name'])
            ->line('Message: ' . $this->data['message'])
            ->action('View Support Requests', url('/support'))
            ->line('Thank you for using our application!');
    }

    /**
     * Send a database notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\DatabaseMessage
     */
    public function toArray(object $notifiable): array
    {
        return [
            'name' => $this->data['name'],
            'email' => $this->data['email'],
            'message' => $this->data['message'],
        ];
    }
}
