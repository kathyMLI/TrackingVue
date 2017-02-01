<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TrackingCreateNotification extends Notification
{
    use Queueable;

    protected $user;
    protected $code;
    protected $description;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($userName, $trackingCode, $trackingDescription)
    {
        $this->user = $userName;
        $this->code = $trackingCode;
        $this->description = $trackingDescription;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $user = $this->user;
        $code = $this->code;
        $description = $this->description;

        return (new MailMessage)
            ->subject('Nuevo tracking')
            ->markdown('mail.tracking.create', compact('user', 'code', 'description'));
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
            //
        ];
    }
}
