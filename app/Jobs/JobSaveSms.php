<?php

namespace App\Jobs;

use App\Models\Sms;
use App\Models\User;
use DateTime;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class JobSaveSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $UserID, $Phone, $Message, $Response;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($UserID, $Phone, $Message, $Response)
    {
        $this->UserID = $UserID;
        $this->Phone = $Phone;
        $this->Message = $Message;
        $this->Response = strval($Response);
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $User = User::find($this->UserID);
        if (strval(new DateTime(Date('Y-m-d')) <= new DateTime($User->expiry_date))) {
            if ($User->remaining_of_sms > 0) {

                Log::info("User: " . $this->UserID);
                Log::info("Phone: " . $this->Phone);
                Log::info("Message: " . $this->Message);
                Log::info("Response:" . $this->Response);

                $SMS = new Sms();
                $SMS->user_id = $this->UserID;
                $SMS->sms = $this->Message;
                $SMS->phone_number = $this->Phone;
                $SMS->response = $this->Response;
                $SMS->save();

                $User->remaining_of_sms = $User->remaining_of_sms - intval((Str::length($this->Message) / 160) + 1);
                $User->save();
            }
        }
    }
}
