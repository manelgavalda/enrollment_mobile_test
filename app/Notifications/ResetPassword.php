<?php

namespace Manelgavalda\EnrollmentMobileTest\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPassword extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Public token for user class.
     */
    public $token;

    /**
     * ResetPassword constructor.
     * @param $token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }


    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {

        $url = url('password/reset/' . $this->token);

        return (new MailMessage)
        ->markdown('mails.resetpassword', $url)
        ->subject('Enrollment Mobile Password Reset');
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