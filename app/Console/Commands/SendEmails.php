<?php

namespace App\Console\Commands;

use App\Mail\NotifyEmail;
use App\Models\User;
use App\Notifications\EmailNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:users-not-logged-in-for-month';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email to a user who didn’t log in from the past month';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $emails=User::join('clients','clients.user_id','users.id')->pluck('email','last_login')->toArray();


        foreach($emails as $last_login=>$email){

            $to = Carbon::now();
            $from = Carbon::createFromFormat('Y-m-d', $last_login);
            $diff_in_months = $to->diffInMonths($from);
               if($diff_in_months >= 1){

                 $user=User::where("email",$email)->first();
                Notification::send($user,new EmailNotification());
                // Mail::To($email)->send(new NotifyEmail());
            }
            
        }
    }
}
