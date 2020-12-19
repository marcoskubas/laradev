<?php

namespace LaraDev\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class welcomeYakso extends Mailable
{
    //implements ShouldQueue //Envia para a fila sempre

    use Queueable, SerializesModels;

    private $user;

    private $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(\stdClass $user, \stdClass $order)
    {
        $this->user  = $user;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject = "Seja muito bem vindo ao Laravel Developer";
        $this->to($this->user->email, $this->user->name);
        return $this->markdown('mail.welcomeYakso')->with(['user' => $this->user, 'order' => $this->order]);
    }
}
