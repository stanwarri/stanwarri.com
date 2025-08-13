<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'community:seed-test-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate fresh test data for the book community system';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (!$this->confirm('This will delete all existing data and create fresh test data. Continue?')) {
            $this->info('Operation cancelled.');
            return;
        }

        $this->info('🔄 Refreshing database and generating test data...');
        
        $this->call('migrate:fresh', ['--seed' => true]);
        
        $this->newLine();
        $this->info('✅ Test data generated successfully!');
        $this->info('🎯 You can now access the admin panel at /admin');
        $this->info('📧 Login with: stanley.warri@gmail.com');
        $this->newLine();
    }
}
