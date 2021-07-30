<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendBirthdaySms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:birthday_sms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will send the birthday sms to memebers';

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
     * @return int
     */
    public function handle()
    {
        $this->info("Hi");
    }
}
