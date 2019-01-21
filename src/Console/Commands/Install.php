<?php

namespace Jdsf\MiniForum\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jdsf:miniforum:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'install miniforum';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
         $this->info("### Jdsf\miniforum 开始安装. 请稍等...");
         $this->executeProcess('php artisan vendor:publish --provider="Jdsf\MiniForum\MiniForumServiceProvider"', 'publishing migrations files');
         $this->executeProcess('php artisan migrate --force --path=/database/migrations/miniforum', '创建表');
         $this->info("### Jdsf\miniforum 开始安装 ok");
    }


    /**
         * Run a SSH command.
         *
         * @param string $command      The SSH command that needs to be run
         * @param bool   $beforeNotice Information for the user before the command is run
         * @param bool   $afterNotice  Information for the user after the command is run
         *
         * @return mixed Command-line output
         */
        public function executeProcess($command, $beforeNotice = false, $afterNotice = false)
        {
            if ($beforeNotice) {
                $this->info('### '.$beforeNotice);
            } else {
                $this->info('### Running: '.$command);
            }
            $process = new Process($command);
            $process->run(function ($type, $buffer) {
                if (Process::ERR === $type) {
                    echo '... > '.$buffer;
                } else {
                    echo 'OUT > '.$buffer;
                }
            });
            // executes after the command finishes
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }
            if ($afterNotice) {
                $this->info('### '.$afterNotice);
            }
        }
}
