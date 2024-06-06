<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;


class ConfirmedBookingNotificationByIdUser extends Notification
{
    use Queueable;
    // public $message;
    // public $subject;
    // public $fromEmail;
    // public $mailer;

    // private $details;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->message = "You Logged in";
        // $this->subject = "New Logged in";
        // $this->fromEmail = "ricobregildo@gmial.com";
        // $this->mailer = "smtp";
        // $this->details = $details;
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

        $booking = Booking::where('user_id', $notifiable->id)->firstOrNew();



        // return (new MailMessage)
        //             ->greeting($this->details['greeting'])
        //             ->line($this->details['body'])
        //             ->action($this->details['actiontext'],$this->details['actionurl'])
        //             ->line($this->details['lastline']);

        // return (new MailMessage)
        //     ->subject('Confirmed Booking')
        //     ->greeting('Hi ' . $notifiable->name)
        //     ->line('Your booking request has been confirmed.')
        //     ->action('View Details', url('/booking/details'))
        //     ->line('Thank you for choosing our service!')
        //     ->attach(public_path('/assets/images/samples/car.png'), [
        //         'as' => 'custom-image.jpg',
        //         'mime' => 'image/jpeg',
        //     ]);


        // return (new MailMessage)
        // ->subject('Your booking has been verified')
        // ->greeting('Hi ' . $notifiable->name)
        // ->line('Great news! Your booking is confirmed! Please visit our store on the specified
        // date for a smooth pick-up and an easy payment process.
        // Your exciting journey with us is about to begin. Enjoy the ride!')
        // ->action('For more info visit our FB page', url('https://www.facebook.com/profile.php?id=61552501830668'))
        // ->line('Thank you for choosing our service!');
        return (new \Illuminate\Notifications\Messages\MailMessage)
        ->subject('Your booking has been verified')
        // ->markdown('emails.custom_email');
        ->markdown('emails.custom_email', ['name' => $notifiable->name]);


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
