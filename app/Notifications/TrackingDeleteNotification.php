<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TrackingDeleteNotification extends Notification
{
    use Queueable;

    protected $code;
    protected $name;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($trackingCode, $userName)
    {
        $this->code = $trackingCode;
        $this->name = $userName;
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
        $name = $this->name;

        return (new MailMessage)
            ->subject('Tracking ' + $code + ' eliminado')
            ->markdown('mail.tracking.delete', compact('code', 'name'));
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
