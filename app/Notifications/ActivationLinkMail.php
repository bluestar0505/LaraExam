<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ActivationLinkMail extends Notification
{
    use Queueable;

    private $link;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($link)
    {
        $this->link = $link;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Welcome!')
            ->greeting('Hey there and welcome to ExamHack!,')
            ->line('You’re now just one click away from joining the ExamHack community, and here are some of the things you have to look forward to:')
            ->line('     - Your very own solution portfolio')
            ->line('     - An exclusive catalogue of over 300 top class past paper solutions')
            ->line('     - Bargain prices from 95c per solution + built in discounts and rewards')
            ->line('     - A team of dedicated experts ready to lend you a hand when you need us')
            ->line('Now what are you waiting for? Press the confirmation link below and start your journey today!')
            ->action('Activation link', $this->link)
            ->line('Kind Regards,')
            ->line('    The ExamHack Team');
    }
}
