<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WalletVerification extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $wallet;
    protected $coin;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $wallet, $coin)
    {
        $this->user = $user;
        $this->wallet = $wallet;
        $this->coin = $coin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         return $this->view('email.wallet')->with(['user' => $this->user, 'wallet' => $this->wallet, 'coin' => $this->coin]);
    }
}
