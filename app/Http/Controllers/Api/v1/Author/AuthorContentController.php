<?php

namespace App\Http\Controllers\Api\v1\Author;

use App\Jobs\UploadVideo;
use Illuminate\Http\Request;
use App\Repositories\Contracts\ILesson;
use App\Repositories\Contracts\IContent;
use App\Http\Resources\ContentResource;
use App\Http\Controllers\Controller;
//use App\Jobs\ConvertVideoForStreaming;


class AuthorContentController extends Controller
{
    
    protected $lessons;
    protected $contents;
    
    public function __construct(ILesson $lessons, IContent $contents)
    {
        $this->lessons = $lessons;
        $this->contents = $contents;
    }
    
    public function findByLesson($id)
    {
        $content = $this->contents->findByLesson($id);
        
        return new ContentResource($content);
    }
    
    public function uploadVideo(Request $request, $id)
    {
        //dd($request->all());
        $lesson = $this->lessons->find($id);
        $originalFileName = $request->file('file')->getClientOriginalName();
        $ext = $request->file('file')->extension();
        $getID3 = new \getID3;
        $file = $getID3->analyze($request->file('file'));
        $duration_in_seconds = $file['playtime_seconds'];
        if($lesson->content && $lesson->content->count()){
            $currentVideo = $lesson->content->video_filename;
            $this->contents->destroy($lesson->content->id);
            $this->contents->deleteVideo($currentVideo);
        }
        $file_base = time() . '-' . substr(\Str::slug($originalFileName), 0, -3);
        $filename = $file_base .'.'.$ext;
        $path = $request->file('file')->storeAs('uploads', $filename, 'tmpStorage');
     
        
        $content = $this->contents->createVideoContent([
            'content_type' => 'video',
            'video_filename' => $filename,
            'video_duration' => $duration_in_seconds/60, // duration in seconds
            'video_path' => config('site_settings.video_upload_location') == 's3' ? \Storage::disk('s3')->url($filename) : '/uploads/videos/'.$filename,
            'video_src' => 'upload',
            'video_storage' => config('site_settings.video_upload_location')   
        ], $id);

        // if job fails, remove the content
        if(setting('site.encode_videos')){
            ConvertVideoForStreaming::dispatch($content);
        } else {
            UploadVideo::dispatch($filename);
        }
        
        return new ContentResource($content);
        
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->type=='youtube'){
            $this->validate($request, [
                'url' => 'required|url|youtube',
                'duration' => 'required|numeric|min:1'
            ]);
            
            return $this->contents->createYoutube($request->all());
        }
        
        $this->validate($request, [
            'content' => 'required|string',
        ]);
        
        return $this->contents->create($request->all());
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->type=='youtube'){
            $this->validate($request, [
                'url' => 'required|url|youtube',
                'duration' => 'required|numeric|min:1'
            ]);
            
            return $this->contents->updateYoutube($request->all(), $id);
        }
        
        $this->validate($request, [
            'content' => 'required|string',
        ]);
        
        return $this->contents->update([
            'content' => $request->content
        ], $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
