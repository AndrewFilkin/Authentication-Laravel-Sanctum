<?php

namespace App\Console\Commands\Auth;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
        $now = Carbon::now();

        $oneDayAgo = $now->subDay();

        $tokensToDelete = DB::table('personal_access_tokens')->where('expires_at', '<', $oneDayAgo)->delete();

        $this->info($tokensToDelete);
    }
}
