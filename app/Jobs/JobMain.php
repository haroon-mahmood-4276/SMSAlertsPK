<?php

namespace App\Jobs;

use App\Models\Mobiledatas;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;

class JobMain implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;


    public $RequestInput, $Members, $SessionData;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($SessionData, $RequestInput)
    {
        $this->SessionData = $SessionData;
        $this->RequestInput = $RequestInput;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $Message = $this->RequestInput['message'];

        foreach ($this->RequestInput as $Data) {
            if (substr($Data, -3) == 'chk') {

                $Member = Mobiledatas::join('users', 'mobiledatas.user_id', '=', 'users.id')
                    ->join('groups', 'mobiledatas.group_id', '=', 'groups.id')
                    ->join('sections', 'mobiledatas.section_id', '=', 'sections.id')
                    ->select('mobiledatas.id', 'mobiledatas.code', 'mobiledatas.student_first_name', 'mobiledatas.student_last_name', 'mobiledatas.student_mobile_1', 'mobiledatas.student_mobile_2', 'mobiledatas.parent_first_name', 'mobiledatas.parent_last_name', 'mobiledatas.parent_mobile_1', 'mobiledatas.parent_mobile_2', 'mobiledatas.active', 'groups.name AS group_name', 'sections.name AS section_name')
                    ->where('mobiledatas.user_id', '=', $this->SessionData['id'])
                    ->where('mobiledatas.code', '=', substr($Data, 0, -3))->get();


                $ReplacedMessage = "";
                if ($this->SessionData['company_nature'] == 'B') {
                    $ReplacedMessage = str_replace('[member_full_name]', $Member[0]->student_first_name . " " . $Member[0]->student_last_name, $Message);
                    $ReplacedMessage = str_replace('[brand_name]', $this->SessionData['company_name'], $ReplacedMessage);
                    $ReplacedMessage = str_replace('[brand_phone_1]', $this->SessionData['mobile_1'], $ReplacedMessage);
                    $ReplacedMessage = str_replace('[brand_phone_2]', $this->SessionData['mobile_2'], $ReplacedMessage);
                    $ReplacedMessage = str_replace('[brand_email]', $this->SessionData['company_email'], $ReplacedMessage);
                } else {
                    $ReplacedMessage = str_replace('[student_full_name]', $Member[0]->student_first_name . " " . $Member[0]->student_last_name, $Message);
                    $ReplacedMessage = str_replace('[class_name]', $Member[0]->group_name, $ReplacedMessage);
                    $ReplacedMessage = str_replace('[section_name]', $Member[0]->section_name, $ReplacedMessage);
                    $ReplacedMessage = str_replace('[school_name]', $this->SessionData['company_name'], $ReplacedMessage);
                    $ReplacedMessage = str_replace('[school_phone_1]', $this->SessionData['mobile_1'], $ReplacedMessage);
                    $ReplacedMessage = str_replace('[school_phone_2]', $this->SessionData['mobile_2'], $ReplacedMessage);
                    $ReplacedMessage = str_replace('[school_email]', $this->SessionData['company_email'], $ReplacedMessage);
                }

                JobSendSms::dispatch($this->SessionData['id'], $this->SessionData['company_username'], $this->SessionData['company_password'], $this->SessionData['company_mask_id'], $Member[0]->parent_mobile_1, $ReplacedMessage);

                if (isset($this->RequestInput['parent_secondary_number']) && $this->RequestInput['parent_secondary_number'] == "on")
                    if ($Member[0]->parent_mobile_2 != null && $Member[0]->parent_mobile_2 != '')
                        JobSendSms::dispatch($this->SessionData['id'], $this->SessionData['company_username'], $this->SessionData['company_password'], $this->SessionData['company_mask_id'], $Member[0]->parent_mobile_2, $ReplacedMessage);

                if (isset($this->RequestInput['student_primary_number']) && $this->RequestInput['student_primary_number'] == "on")
                    if ($Member[0]->student_mobile_1 != null && $Member[0]->student_mobile_1 != '')
                        JobSendSms::dispatch($this->SessionData['id'], $this->SessionData['company_username'], $this->SessionData['company_password'], $this->SessionData['company_mask_id'], $Member[0]->student_mobile_1, $ReplacedMessage);

                if (isset($this->RequestInput['student_secondary_number']) && $this->RequestInput['student_secondary_number'] == "on")
                    if ($Member[0]->student_mobile_2 != null && $Member[0]->student_mobile_2 != '')
                        JobSendSms::dispatch($this->SessionData['id'], $this->SessionData['company_username'], $this->SessionData['company_password'], $this->SessionData['company_mask_id'], $Member[0]->student_mobile_2, $ReplacedMessage);
            }
        }
    }
}
