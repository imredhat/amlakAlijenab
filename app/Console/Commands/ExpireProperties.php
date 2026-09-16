<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ExpireProperties extends Command
{
    protected $signature = 'property:expire';
    protected $description = 'Mark properties as expired after 30 days';

    public function handle(): int
    {
        $expiredCount = DB::table('property')
            ->where('status', '!=', 'منقضی')
            ->whereNotNull('expires_at')
            ->where('expires_at', '<=', now())
            ->update([
                'status' => 'منقضی',
                '_status' => 'expired',
            ]);

        $this->info("{$expiredCount} property/properties marked as expired.");

        return Command::SUCCESS;
    }
}
