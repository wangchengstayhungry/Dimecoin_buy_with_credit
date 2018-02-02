<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;
use App\Mail\CompletionConfirm;
class SendCompletionEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $order;
    protected $user;
    protected $coins;
    /**
     * Create a new job instance.
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new CompletionConfirm($this->order, $this->user, $this->coins);
        Mail::to($this->order->email)->send($email);
    }
}
