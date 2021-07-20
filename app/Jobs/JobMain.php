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
    use Dispatchable, InteractsWithQueue, Queueable;


    public $RequestInput, $Members, $SessionData;
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
        // dd($this->Members);
        $Message = $this->RequestInput['message'];
        foreach ($this->Members as $Member) {
            if (Arr::exists($this->RequestInput, $Member->id . 'chk')) {
                $ReplacedMessage = "";
                if ($this->SessionData['company_nature'] == 'B') {
                    $ReplacedMessage = Str::replaceArray('[member_full_name]', [$Member->student_first_name . " " . $Member->student_last_name], $Message);
                    $ReplacedMessage = Str::replaceArray('[account_name]', [$this->SessionData['first_name'] . " " . $this->SessionData['last_name']], $ReplacedMessage);
                    $ReplacedMessage = Str::replaceArray('[brand_name]', [$this->SessionData['company_name']], $ReplacedMessage);
                    $ReplacedMessage = Str::replaceArray('[brand_mask]', [$this->SessionData['company_mask_id']], $ReplacedMessage);
                    $ReplacedMessage = Str::replaceArray('[brand_email]', [$this->SessionData['company_email']], $ReplacedMessage);
                } else {
                    $ReplacedMessage = Str::replaceArray('[student_full_name]', [$Member->student_first_name . " " . $Member->student_last_name], $Message);
                    $ReplacedMessage = Str::replaceArray('[account_name]', [$this->SessionData['first_name'] . " " . $this->SessionData['last_name']], $ReplacedMessage);
                    $ReplacedMessage = Str::replaceArray('[class_name]', [$Member['group_name']], $ReplacedMessage);
                    $ReplacedMessage = Str::replaceArray('[section_name]', [$Member['section_name']], $ReplacedMessage);
                    $ReplacedMessage = Str::replaceArray('[school_name]', [$this->SessionData['company_name']], $ReplacedMessage);
                    $ReplacedMessage = Str::replaceArray('[school_mask]', [$this->SessionData['company_mask_id']], $ReplacedMessage);
                    $ReplacedMessage = Str::replaceArray('[school_email]', [$this->SessionData['company_email']], $ReplacedMessage);
                }

                DB::table('test')->insert(
                    [
                        ['message' =>  $ReplacedMessage],
                    ]
                );
                JobSendSms::dispatch($this->SessionData['id'], $this->SessionData['company_username'], $this->SessionData['company_password'], $this->SessionData['company_mask_id'], $Member->parent_mobile_1, $ReplacedMessage);
            }
        }
    }
}
