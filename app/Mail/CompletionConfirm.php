<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CompletionConfirm extends Mailable
{
    use Queueable, SerializesModels;
    protected $order;
    protected $user;
    protected $coins;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $user, $coins)
    {
        $this->order = $order;
        $this->user = $user;
        $this->coins = $coins;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.email')->with(['user' => $this->user, 'order' => $this->order, 'coins' => $this->coins]);
    }
}
