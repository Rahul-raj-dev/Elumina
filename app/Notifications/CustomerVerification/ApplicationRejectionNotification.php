<?php

namespace App\Notifications\CustomerVerification;

use Illuminate\Bus\Queueable;
// use Illuminate\Support\Facades\Log;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ApplicationRejectionNotification extends Notification implements ShouldQueue {
  use Queueable;

  private $remarks;

  /**
   * Create a new notification instance.
   *
   * @return void
   */
  public function __construct($remarks) {
    $this->remarks = $remarks;
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
   * @param  mixed  $notifiable
   * @return \Illuminate\Notifications\Messages\MailMessage
   */
  public function toMail($customer) {
    return (new MailMessage)
        ->subject('Application Rejected - Elumina')
        ->markdown('mails.verifications.application.rejection', [
          'customer'  => $customer,
          'remarks'  => $this->remarks
        ]);
  }

  /**
   * Get the array representation of the notification.
   *
   * @param  mixed  $notifiable
   * @return array
   */
  public function toArray($notifiable) {
    return [
      //
    ];
  }
}
