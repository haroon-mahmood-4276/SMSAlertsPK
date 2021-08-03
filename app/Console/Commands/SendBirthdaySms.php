<?php

namespace App\Console\Commands;

use App\Jobs\JobSendSms;
use App\Models\Mobiledatas;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

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
        $MessagesData = Mobiledatas::join('users', 'mobiledatas.user_id', '=', 'users.id')
            ->join('groups', 'mobiledatas.group_id', '=', 'groups.id')
            ->join('sections', 'mobiledatas.section_id', '=', 'sections.id')
            ->join('settings', 'mobiledatas.user_id', '=', 'settings.user_id')
            ->select('users.id', 'users.company_name', 'users.mobile_1', 'users.mobile_2', 'users.company_email', 'users.company_nature', 'mobiledatas.code', 'mobiledatas.student_first_name', 'mobiledatas.student_last_name', 'mobiledatas.student_mobile_1', 'mobiledatas.student_mobile_2', 'mobiledatas.parent_mobile_1', 'mobiledatas.parent_mobile_2',  'groups.name AS group_name', 'sections.name AS section_name', 'settings.birthday_message', 'settings.birthday_enabled', 'settings.parent_primary_number', 'settings.parent_secondary_number', 'settings.student_primary_number', 'settings.student_secondary_number')
            ->where('dob', '=', Carbon::today()->toDateString())
            ->where('active', '=', 'Y')
            ->where('settings.birthday_enabled', '=', 'Y')->get();

        foreach ($MessagesData as $Member) {

            $ReplacedMessage = "";
            if ($Member->company_nature == 'B') {
                $ReplacedMessage = str_replace('[member_full_name]', $Member->student_first_name . " " . $Member->student_last_name, $Member->birthday_message);
                $ReplacedMessage = str_replace('[brand_name]', $Member->company_name, $ReplacedMessage);
                $ReplacedMessage = str_replace('[brand_phone_1]', $Member->mobile_1, $ReplacedMessage);
                $ReplacedMessage = str_replace('[brand_phone_2]', $Member->mobile_2, $ReplacedMessage);
                $ReplacedMessage = str_replace('[brand_email]', $Member->company_email, $ReplacedMessage);
            } else {
                $ReplacedMessage = str_replace('[student_full_name]', $Member->student_first_name . " " . $Member->student_last_name, $Member->birthday_message);
                $ReplacedMessage = str_replace('[class_name]', $Member->group_name, $ReplacedMessage);
                $ReplacedMessage = str_replace('[section_name]', $Member->section_name, $ReplacedMessage);
                $ReplacedMessage = str_replace('[school_name]', $Member->company_name, $ReplacedMessage);
                $ReplacedMessage = str_replace('[school_phone_1]', $Member->mobile_1, $ReplacedMessage);
                $ReplacedMessage = str_replace('[school_phone_2]', $Member->mobile_2, $ReplacedMessage);
                $ReplacedMessage = str_replace('[school_email]', $Member->company_email, $ReplacedMessage);
            }

            JobSendSms::dispatch($Member->id, $Member->company_username, $Member->company_password, $Member->company_mask_id, $Member->parent_mobile_1, $ReplacedMessage);

            if (isset($this->RequestInput['parent_secondary_number']) && $Member->parent_secondary_number == "Y")
                if ($Member->parent_mobile_2 != null && $Member->parent_mobile_2 != '')
                    JobSendSms::dispatch($Member->id, $Member->company_username, $Member->company_password, $Member->company_mask_id, $Member->parent_mobile_2, $ReplacedMessage);

            if (isset($this->RequestInput['student_primary_number']) && $Member->student_primary_number == "Y")
                if ($Member->student_mobile_1 != null && $Member->student_mobile_1 != '')
                    JobSendSms::dispatch($Member->id, $Member->company_username, $Member->company_password, $Member->company_mask_id, $Member->student_mobile_1, $ReplacedMessage);

            if (isset($this->RequestInput['student_secondary_number']) && $Member->student_secondary_number == "Y")
                if ($Member->student_mobile_2 != null && $Member->student_mobile_2 != '')
                    JobSendSms::dispatch($Member->id, $Member->company_username, $Member->company_password, $Member->company_mask_id, $Member->student_mobile_2, $ReplacedMessage);
        }
    }
}
