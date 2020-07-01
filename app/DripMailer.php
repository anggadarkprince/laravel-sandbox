<?php

namespace App;

use App\Mail\WelcomeMessage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class DripMailer extends Model
{
    /**
     * Send mailer user.
     *
     * @param User $user
     * @param bool $isQueued
     * @param string $info
     */
    public function send(User $user, $isQueued = false, $info = '')
    {
        if ($isQueued) {
            Mail::to($user)->queue(new WelcomeMessage($user, $info));
        } else {
            Mail::to($user)->send(new WelcomeMessage($user, $info));
        }
    }
}
