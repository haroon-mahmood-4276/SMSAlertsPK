<?php

namespace App\Jobs;

use App\Models\User;
use DateTime;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class JobSendSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $UserID, $UserName, $Password, $Sender, $Phone, $Message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($UserID, $UserName, $Password, $Sender, $Phone, $Message)
    {
        $this->UserID = $UserID;
        $this->UserName = $UserName;
        $this->Password = $Password;
        $this->Sender = $Sender;
        $this->Phone = $Phone;
        $this->Message = $Message;
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
                $Msgs = intval(((Str::length($this->Message) / 160) + 1));
                if ($Msgs <= $User->remaining_of_sms) {

                    // $response =  Http::get('https://portal.sms.web.pk/api/send', [
                    //     'username' => $this->UserName,
                    //     'password' => $this->Password,
                    //     'mask' => $this->Sender,
                    //     'mobile' => $this->Phone,
                    //     'message' => $this->Message,
                    // ]);

                    $response = "success";
                    JobSaveSms::dispatch($this->UserID, $this->Phone, $this->Message, $response);
                }
            }
        }
    }
}
