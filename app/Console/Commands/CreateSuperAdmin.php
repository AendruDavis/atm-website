<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('admin:create')]
#[Description('Command description')]
class CreateSuperAdmin extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
    }
}
