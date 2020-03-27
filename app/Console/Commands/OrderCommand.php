<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Model\Order;

class OrderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:delete_OrderNotActive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete Order Not Acive Email When Checkout';

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
        Order::where('created_at', '<', Carbon::now()->subMinute())->where('status','4')->delete();
    }
}
