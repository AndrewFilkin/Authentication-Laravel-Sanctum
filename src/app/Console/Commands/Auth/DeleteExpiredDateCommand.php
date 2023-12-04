<?php

namespace App\Console\Commands\Auth;

use Illuminate\Console\Command;

class DeleteExpiredDateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crone:deleteExpiredDate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete expired date use crone';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('My cron job ran successfully!');
    }
}
