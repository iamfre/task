<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMessage extends Mailable
{
    use Queueable, SerializesModels;

    protected $group;
    protected $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $group)
    {
        $this->name = $name;
        $this->group = $group;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $emailFrom = 'group_admin@free.net';
        return $this->from($emailFrom)->view('send-message', ['name' => $this->name, 'group' => $this->group]);
    }
}
