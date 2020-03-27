<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Model\User;

class UserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:delete_UserNotActive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete User Not Acive Email When Register Account';

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
       User::where('created_at', '<', Carbon::now()->subMinute())->where('is_activated','0')->delete();
       $this->info('Run Command Successfully!');
    }
}
