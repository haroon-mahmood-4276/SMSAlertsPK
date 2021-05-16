<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class JobMain implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $RequestInput;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($RequestInput)
    {
        $this->RequestInput = $RequestInput;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $Members = app('App\Http\Controllers\MobileDataController')->STDList($this->RequestInput['group'], $this->RequestInput['section']);
        Log::info($Members);
        DB::table('test')->insert(
            [['name' => $this->RequestInput['group']],
            ['name' => $this->RequestInput['section']]]
        );
    }
}
