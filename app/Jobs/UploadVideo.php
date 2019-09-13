<?php

namespace App\Jobs;

use File;
use Storage;
use Carbon\Carbon;
use App\Models\Video;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UploadVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $video;
    
    public function __construct(Video $video)
    {
        $this->video = $video;
    }
    public function handle()
    {
        $storage_location = setting('site.video_upload_location');
        $file = storage_path() . '/uploads/' . $this->video->original_filename;
        
        if($storage_location == 'local'){
            if(Storage::disk('server')->put('videos/'.$this->video->original_filename, fopen($file, 'r+'))) {
                File::delete($file);
            };
        } else {
            if(Storage::disk($storage_location)->put($this->video->original_filename, fopen($file, 'r+'))) {
                File::delete($file);
            }
        }

        // update the video after upload and the lesson
        
    }
}
