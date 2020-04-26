<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeNewCustomerMail;

class WelcomeNewCustomerListener implements ShouldQueue
{



    public function handle($event)
    {
      //dd($event->customer->email);

        Mail::to($event->customer->email)->send(new WelcomeNewCustomerMail());
    }
}
