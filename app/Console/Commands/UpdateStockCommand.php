<?php

namespace App\Console\Commands;

use App\Http\Controllers\User\UserController;
use Illuminate\Console\Command;

class UpdateStockCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stock:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch latest market cap';

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
     * @return void
     */
    public function handle()
    {
        UserController::updateMarketCap();
        UserController::updateStock();
    }
}
