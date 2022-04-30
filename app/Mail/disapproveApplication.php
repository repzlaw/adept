<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class disapproveApplication extends Mailable
{
    use Queueable, SerializesModels;
    public $subject = "Application Disapproved";
    public $name;
    public $amount;
    public $goods;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $amount, $goods)
    {
        $this->name = $name;
        $this->amount = $amount;
        $this->goods = $goods;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.disapproveApplication');
    }
}
