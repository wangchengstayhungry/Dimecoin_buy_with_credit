<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderNotification extends Mailable
{
    use Queueable, SerializesModels;
    protected $user;
    protected $data;
    protected $payments;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $data, $payments)
    {
        $this->user = $user;
        $this->data = $data;
        $this->payments = $payments;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.orderNotification')->with(['user' => $this->user, 'data' => $this->data, 'payments' => $this->payments]);
    }
}
