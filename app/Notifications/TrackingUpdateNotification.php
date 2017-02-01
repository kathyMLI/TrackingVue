<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TrackingUpdateNotification extends Notification
{
    use Queueable;

    protected $code;
    protected $description;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($trackingCode, $trackingDescription)
    {
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
        $code = $this->code;
        $description = $this->description;

        return (new MailMessage)
            ->markdown('mail.tracking.create', compact('code', 'description'));
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
