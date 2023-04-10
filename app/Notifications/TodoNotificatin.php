<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use OneSignal;


// use NotificationChannels\OneSignal\OneSignalMessage;
// use NotificationChannels\OneSignal\OneSignalChannel;

class TodoNotificatin extends Notification
{
    use Queueable;
    public $todo;
    

    /**
     * Create a new notification instance.
     * @param $todo
     * 
     * 
     * 
     */
    public function __construct($todo)
    {
        $this->todo = $todo;
        
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {

        return ['database','broadcast'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'todo_id' => $this->todo->id,
            'message' => $this->todo->title,
            'username' => $this->todo->user->username,
        ];
    }

    public function  toBroadcast(object $notifiable): BroadcastMessage
    {
        return (new BroadcastMessage([
            'todo_id' => $this->todo->id,
            'message' => $this->todo->title,
            'username' => $this->todo->user->username,
        ]));
    }

    /**
     * Get the type of the notification being broadcast.
     */
    // public function broadcastType(): string
    // {
    //     return 'broadcast.message';
    // }

}
