<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;
use App\Mail\OrderNotification;

class SendOrderEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $data;
    protected $payments;
        /**
     * Create a new job instance.
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new OrderNotification($this->user, $this->data, $this->payments);
        Mail::to($this->user->email)->send($email);
    }
}
