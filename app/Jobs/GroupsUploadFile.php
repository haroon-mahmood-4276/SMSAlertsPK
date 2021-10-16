<?php

namespace App\Jobs;

use App\Imports\GroupsImport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class GroupsUploadFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $UserID, $Path;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($UserID, $Path)
    {
        $this->UserID = $UserID;
        $this->Path = $Path;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $import = new GroupsImport($this->UserID);
        $import->import($this->Path);
        Storage::delete([$this->Path]);
    }
}
