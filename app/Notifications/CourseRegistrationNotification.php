<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CourseRegistrationNotification extends Notification
{
    use Queueable;

    public $data;

    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable)
    {
        return [
            'course_name' => $this->data['course_name'],
            'instructor_id' => $this->data['instructor_id'],
            'student_name' => $this->data['student_name'],
            'registration_date' => $this->data['registration_date'],
        ];
    }
}
