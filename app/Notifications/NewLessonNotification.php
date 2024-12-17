<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class NewLessonNotification extends Notification
{
    use Queueable;

    public $lessonTitle;
    public $courseName;
    public $courseID;
    public $courseInstructor;

    /**
     * Create a new notification instance.
     *
     * @param string $lessonTitle
     * @param string $courseName
     * @param string $courseInstructor
     */
    public function __construct($lessonTitle, $courseName, $courseInstructor, $courseID)
    {
        $this->lessonTitle = $lessonTitle;
        $this->courseName = $courseName;
        $this->courseID = $courseID;
        $this->courseInstructor = $courseInstructor;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'lesson_title' => $this->lessonTitle,
            'course_name' => $this->courseName,
            'course_instructor' => $this->courseInstructor,
            'course_id' => $this->courseID,
        ];
    }
}
