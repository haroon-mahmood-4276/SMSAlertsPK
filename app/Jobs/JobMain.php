<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class JobMain implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $RequestInput, $Members, $SessionData;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($SessionData, $RequestInput, $Members)
    {
        $this->SessionData = $SessionData;
        $this->RequestInput = $RequestInput;
        $this->Members = $Members;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $Message = $this->RequestInput['message'];
        foreach ($this->Members as $Member) {
            if (Arr::exists($this->RequestInput, $Member->id . 'chk')) {

                $ReplacedMessage = Str::replaceArray('[first_name]', [$Member->student_first_name], $Message);
                $ReplacedMessage = Str::replaceArray('[last_name]', [$Member->student_last_name], $ReplacedMessage);

                DB::table('test')->insert(
                    [
                        ['name' =>  $ReplacedMessage],
                    ]
                );
                JobSendSms::dispatch($this->SessionData['id'], $this->SessionData['company_username'], $this->SessionData['company_password'], $this->SessionData['company_mask_id'], $Member->parent_mobile_1, $ReplacedMessage );
            }
        }
    }
}
