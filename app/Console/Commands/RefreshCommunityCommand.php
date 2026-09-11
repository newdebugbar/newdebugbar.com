<?php

namespace App\Console\Commands;

use App\Community\ProjectCommunity;
use Illuminate\Console\Command;

/** Warms the homepage's public community data manually or from the scheduler. */
class RefreshCommunityCommand extends Command
{
    protected $signature = 'app:refresh-community';

    protected $description = 'Refresh the homepage downloads, GitHub stars, and contributor avatars';

    public function handle(ProjectCommunity $community): int
    {
        if (! $community->refresh(force: true)) {
            $this->error('Community refresh incomplete. Previous values were retained; check the application log.');

            return self::FAILURE;
        }

        $this->info('The homepage community data is up to date.');

        return self::SUCCESS;
    }
}
