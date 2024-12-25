<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class ServeWithDev extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'serve:with-dev';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run php artisan serve and npm run dev simultaneously';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting Laravel development server and Vite dev server...');

        // Proses untuk `php artisan serve`
        $phpServe = new Process(['php', 'artisan', 'serve']);
        $phpServe->setTimeout(null);

        // Proses untuk `npm run dev`
        $npmDev = new Process(['npm', 'run', 'dev']);
        $npmDev->setTimeout(null);

        // Cek dan jalankan `php artisan serve` jika belum berjalan
        if ($this->isProcessRunning('php', 'artisan serve')) {
            $this->warn('Laravel development server is already running.');
        } else {
            $phpServe->start(function ($type, $output) {
                echo $output;
            });
        }

        // Cek dan jalankan `npm run dev` jika belum berjalan
        if ($this->isProcessRunning('npm', 'run dev')) {
            $this->warn('Vite dev server is already running.');
        } else {
            $npmDev->start(function ($type, $output) {
                echo $output;
            });
        }

        // Tunggu sampai proses selesai
        if ($phpServe->isRunning()) {
            $phpServe->wait();
        }

        if ($npmDev->isRunning()) {
            $npmDev->wait();
        }
    }

    /**
     * Check if a process is already running.
     *
     * @param string $command
     * @param string $argument
     * @return bool
     */
    private function isProcessRunning(string $command, string $argument): bool
    {
        $os = PHP_OS_FAMILY;

        if ($os === 'Windows') {
            $process = new Process(['tasklist']);
            $process->run();

            return strpos(strtolower($process->getOutput()), strtolower("$command $argument")) !== false;
        } elseif ($os === 'Darwin' || $os === 'Linux') {
            $process = new Process(['ps', 'aux']);
            $process->run();

            return strpos($process->getOutput(), "$command $argument") !== false;
        }

        $this->warn('Unsupported operating system for process detection.');
        return false;
    }
}
