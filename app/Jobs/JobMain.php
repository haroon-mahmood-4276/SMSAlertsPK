<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Arr;
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
        $Message = $this->RequestInput['message'];
        foreach ($this->Members as $Member) {
            if (Arr::exists($this->RequestInput, $Member->id . 'chk')) {
                $ReplacedMessage = "";
                if ($this->SessionData['company_nature'] == 'B') {
                    $ReplacedMessage = str_replace('[member_full_name]', $Member->student_first_name . " " . $Member->student_last_name, $Message);
                    $ReplacedMessage = str_replace('[brand_name]', $this->SessionData['company_name'], $ReplacedMessage);
                    $ReplacedMessage = str_replace('[brand_phone_1]', $this->SessionData['mobile_1'], $ReplacedMessage);
                    $ReplacedMessage = str_replace('[brand_phone_2]', $this->SessionData['mobile_2'], $ReplacedMessage);
                    $ReplacedMessage = str_replace('[brand_email]', $this->SessionData['company_email'], $ReplacedMessage);
                } else {
                    $ReplacedMessage = str_replace('[student_full_name]', $Member->student_first_name . " " . $Member->student_last_name, $Message);
                    $ReplacedMessage = str_replace('[class_name]', $Member['group_name'], $ReplacedMessage);
                    $ReplacedMessage = str_replace('[section_name]', $Member['section_name'], $ReplacedMessage);
                    $ReplacedMessage = str_replace('[school_name]', $this->SessionData['company_name'], $ReplacedMessage);
                    $ReplacedMessage = str_replace('[school_phone_1]', $this->SessionData['mobile_1'], $ReplacedMessage);
                    $ReplacedMessage = str_replace('[school_phone_2]', $this->SessionData['mobile_2'], $ReplacedMessage);
                    $ReplacedMessage = str_replace('[school_email]', $this->SessionData['company_email'], $ReplacedMessage);
                }

                JobSendSms::dispatch($this->SessionData['id'], $this->SessionData['company_username'], $this->SessionData['company_password'], $this->SessionData['company_mask_id'], $Member->parent_mobile_1, $ReplacedMessage);

                if ($this->RequestInput['parent_secondary_number'] == "on")
                    if ($Member->parent_mobile_2 != null && $Member->parent_mobile_2 != '')
                        JobSendSms::dispatch($this->SessionData['id'], $this->SessionData['company_username'], $this->SessionData['company_password'], $this->SessionData['company_mask_id'], $Member->parent_mobile_2, $ReplacedMessage);

                if ($this->RequestInput['student_primary_number'] == "on")
                    if ($Member->student_mobile_1 != null && $Member->student_mobile_1 != '')
                        JobSendSms::dispatch($this->SessionData['id'], $this->SessionData['company_username'], $this->SessionData['company_password'], $this->SessionData['company_mask_id'], $Member->student_mobile_1, $ReplacedMessage);

                if ($this->RequestInput['student_secondary_number'] == "on")
                    if ($Member->student_mobile_2 != null && $Member->student_mobile_2 != '')
                        JobSendSms::dispatch($this->SessionData['id'], $this->SessionData['company_username'], $this->SessionData['company_password'], $this->SessionData['company_mask_id'], $Member->student_mobile_2, $ReplacedMessage);
            }
        }
    }
}
