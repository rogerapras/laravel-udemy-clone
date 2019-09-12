<?php

namespace App\Jobs;

use File;
use Storage;
use Carbon\Carbon;
use App\Models\Content;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UploadVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $filename;
    
    public function __construct($filename)
    {
        $this->filename = $filename;
    }
    public function handle()
    {
        $storage_location = setting('site.video_upload_location');
        $file = storage_path() . '/uploads/' . $this->filename;
        
        if($storage_location == 'local'){
            if(Storage::disk('server')->put('videos/'.$this->filename, fopen($file, 'r+'))) {
                File::delete($file);
            };
        } else {
            if(Storage::disk($storage_location)->put($this->filename, fopen($file, 'r+'))) {
                File::delete($file);
            }
        }
        
    }
}
