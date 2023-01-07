<?php

namespace Domain\Commerce\Notifications;

use Domain\Commerce\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCompletedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct()
    {

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
     * @param Order $notifiable
     * @return MailMessage
     */
    public function toMail(Order $notifiable): MailMessage
    {
        return (new MailMessage())
            ->subject("Order Completed")
            ->markdown("email.order", [
                'order' => $notifiable
            ]);
    }
}
