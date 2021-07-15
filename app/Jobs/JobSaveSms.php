<?php

namespace App\Jobs;

use App\Models\Sms;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class JobSaveSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $UserID, $UserName, $Password, $Sender, $Phone, $Message, $Response;
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
        $this->Response = $Response;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $SMS = new Sms();
        $SMS->user_id = $this->UserID;
        $SMS->sms = $this->Message;
        $SMS->phone_number = $this->Phone;
        $SMS->response = $this->Response;
        $SMS->save();

        $User = User::find($this->UserID);
        $User->remaining_of_sms = $User->remaining_of_sms - 1;
        $User->save();
    }
}