<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DevCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'develop';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for development automatization';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        print_r("is {$this->signature} command\n");

    }
}
