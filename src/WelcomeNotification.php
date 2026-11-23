<?php

namespace JawadAhmed\EmailChannel;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

final class WelcomeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;
    public array $backoff = [30, 120, 300];

    public function __construct(private readonly string $dashboardUrl)
    {
        $this->onQueue('emails');
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage())
            ->subject('Welcome to the application')
            ->greeting('Hello '.$notifiable->name.'!')
            ->line('Your account is ready.')
            ->action('Open dashboard', $this->dashboardUrl)
            ->line('If you did not create this account, contact support.');
    }
}
