<?php

namespace App\Notifications\Registration;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Hash;

class SuccessfulRegistration extends Notification implements ShouldQueue {
  use Queueable;

  /**
  * Create a new notification instance.
  *
  * @return void
  */
  public function __construct() {
    //
  }

  /**
  * Get the notification's delivery channels.
  *
  * @param  mixed  $profile
  * @return array
  */
  public function via($customer) {
      return ['mail'];
    }

    /**
  * Get the mail representation of the notification.
  *
  * @param  mixed  $profile
  * @return \Illuminate\Notifications\Messages\MailMessage
  */
  public function toMail($customer) {
      $user           = $customer;
    //   $user->password = Hash::make($password);
      $user->save();

    return (new MailMessage)
    ->subject('Welcome to Elumina elearning')
    ->markdown('mails.registration.successful_registration', ['customer' => $customer]);
  }

  /**
  * Get the array representation of the notification.
  *
  * @param  mixed  $profile
  * @return array
  */
  public function toArray($customer) {
    return [
      //
    ];
  }
}
