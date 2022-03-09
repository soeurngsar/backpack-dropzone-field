<?php

namespace Sarsoeurng\BackpackDropzoneField\App\Console\Commands;

use Backpack\CRUD\app\Console\Commands\Traits\PrettyCommandOutput;
use Illuminate\Console\Command;

class Install extends Command
{
    use PrettyCommandOutput;

    protected $progressBar;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sarsoeurng:backpack:dropzone:install
                                {--timeout=300} : How many seconds to allow each process to run.
                                {--debug} : Show process output or not. Useful for debugging.';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish assets for Dropzone field.';

    /**
     * Execute the console command.
     *
     * @return mixed Command-line output
     */
    public function handle()
    {
        $this->progressBar = $this->output->createProgressBar(2);
        $this->progressBar->minSecondsBetweenRedraws(0);
        $this->progressBar->maxSecondsBetweenRedraws(120);
        $this->progressBar->setRedrawFrequency(1);

        $this->progressBar->start();

        $this->info(' Sarsoeurng\BackpackDropzoneField installation started. Please wait...');
        $this->progressBar->advance();

        $this->line(' Publishing public assets');
        $this->executeArtisanProcess('vendor:publish', [
            '--provider' => 'Sarsoeurng\BackpackDropzoneField\DropzoneFieldServiceProvider',
            '--tag'      => 'public',
        ]);

        $this->progressBar->finish();
        $this->info(' Sarsoeurng\BackpackDropzoneField successfully installed');
    }
}
