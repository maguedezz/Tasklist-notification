<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TaskNotification extends Notification
{
    use Queueable;
    
    public $task;

    /**
     * Create a new notification instance.
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database','mail'];
    }


    // Define how the notification should be stored in the database and how the email should be structured.

    public function toDatabase($notifiable)
    {
    return [
        'message' => "A new task '{$this->task->title}' has been added!",
        'task_id' => $this->task->id,
        ];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->subject('New Task Created')
        ->line("A new task '{$this->task->title}' has been added.")
        ->action('View Task', url('/tasks/' . $this->task->id))
        ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => "A new task '{$this->task->title}' has been added!",
            'task_id' => $this->task->id
        ];
    }
}
