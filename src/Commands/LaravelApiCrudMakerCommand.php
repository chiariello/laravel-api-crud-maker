<?php

namespace Chiariello\LaravelApiCrudMaker\Commands;

use Illuminate\Console\Command;

class LaravelApiCrudMakerCommand extends Command
{
    public $signature = 'laravel-api-crud-maker';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
