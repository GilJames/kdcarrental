<?php

namespace App\Notifications;

use App\Models\Selfdrive;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ConfirmedSelfBookingNotificationByIdUser extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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

        $booking = Booking::where('user_id', $notifiable->id)->first();

        // return (new MailMessage)
        //     ->subject('Your booking has been verified')
        //     ->greeting('Hi ' . $notifiable->name)
        //     ->line('Great news! Your booking is confirmed! Please visit our store on the specified
        //     date for a smooth pick-up and an easy payment process.
        //     Your exciting journey with us is about to begin. Enjoy the ride!')
        //     ->action('For more info visit our FB page', url('https://www.facebook.com/profile.php?id=61552501830668'))
        //     ->line('Thank you for choosing our service!');

                return (new \Illuminate\Notifications\Messages\MailMessage)
        ->subject('Your booking has been verified')
        // ->markdown('emails.custom_email');
        ->markdown('emails.custom_email_self', ['name' => $notifiable->name]);

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
