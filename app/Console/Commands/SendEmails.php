<?php

namespace App\Console\Commands;

use App\DripMailer;
use App\User;
use Illuminate\Console\Command;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send 
                            {user : The ID of the user} 
                            {--Q|queue : Whether the job should be queued}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send drip e-mails to a user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param DripMailer $drip
     * @return void
     */
    public function handle(DripMailer $drip)
    {
        $userId = $this->argument('user');
        $isQueued = $this->option('queue');
        $info = $this->ask('Type additional info? (Press enter to leave it blank)');
        $password = $this->secret('What is the password?');
        if ($password == 'hello') {
            if ($this->confirm('Do you wish to continue?')) {
                if ($this->choice('Really?', ['Yes', 'No'], 0)) {
                    $drip->send(User::find($userId), $isQueued, $info);
                } else {
                    $this->info('Send email is cancelled.');
                }
            } else {
                $this->comment('Send email is aborted.');
            }
        } else {
            $this->error('Password invalid.');
        }
    }
}
