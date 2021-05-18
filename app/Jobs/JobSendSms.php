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
        // $response =  Http::get('http://sms.web.pk/sendsms.php', [
        //     'username' => $this->UserName,
        //     'password' => $this->Password,
        //     'sender' => $this->Sender,
        //     'phone' => $this->Phone,
        //     'message' => $this->Message,
        // ]);
        $response = "success";
        JobSaveSms::dispatch($this->UserID, $this->Phone, $this->Message, $response);
    }
}
