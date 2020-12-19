<?php

namespace LaraDev\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use LaraDev\Mail\welcomeYakso;

class MailController extends Controller
{
    public function email(Request $request){

        $user = new \stdClass();
        $user->name = 'Marcos Kubaszewski';
        $user->email = "marcosarobed@gmail.com";

        $order = new \stdClass();
        $order->type = 'billet';
        $order->due_at = date('Y-m-d');
        $order->value = 697;

        $welcome = new welcomeYakso($user, $order);

        //dd($user, $order);

        Mail::send($welcome);

//        return $welcome;

    }

    public function emailQueue(){

        $user = new \stdClass();
        $user->name = 'Marcos Kubaszewski';
        $user->email = "marcosarobed@gmail.com";

        $order = new \stdClass();
        $order->type = 'billet';
        $order->due_at = date('Y-m-d');
        $order->value = 697;

//        $welcome = new welcomeYakso($user, $order);
//        Mail::queue($welcome);
//        return $welcome;

        \LaraDev\Jobs\welcomeYakso::dispatch($user, $order)->delay(now()->addSeconds(15));

    }
}
