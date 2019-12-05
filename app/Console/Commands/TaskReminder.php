<?php

namespace App\Console\Commands;

use App\Notifications\AccountConfirmation;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class TaskReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remind:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {

        $users = Users::all();

        foreach ($users as $user) {
            if ($users->hasPassedTasks())
                Notification::route("mail", $user->email)
                    ->notify((new \App\Notifications\TaskReminder($user->passedTasks()))->delay(now()->addSeconds(10)));
        }

    }
}
