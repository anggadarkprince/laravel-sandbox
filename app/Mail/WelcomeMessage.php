<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMessage extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var User
     */
    public $user;
    public $info;

    /**
     * Create a new message instance.
     *
     * @param User $user
     * @param string $info
     */
    public function __construct(User $user, $info = '')
    {
        $this->user = $user;
        $this->info = $info;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.welcome');
    }
}
