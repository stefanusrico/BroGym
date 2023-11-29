<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateDummyData extends Command
{
    protected $signature = 'generate:dummy-data';

    protected $description = 'Generate 1000 dummy records';

    public function handle()
    {
        $this->call('db:seed', ['--class' => 'MembershipSeeder']);
        $this->info('Dummy data generated successfully.');
    }
}