<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;
use App\Mail\WalletVerification;

class SendWalletVerificationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $wallet;
    protected $coin;
    /**
     * Create a new job instance.
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new WalletVerification($this->user, $this->wallet, $this->coin);
        Mail::to($this->wallet)->send($email);
    }
}
