<?php

namespace App\Repositories\Eloquent;

use App\Models\Lesson;
use App\Models\Section;
use App\Models\Content;
use App\Repositories\Contracts\IContent;
use App\Http\Resources\ContentResource;


class ContentRepository extends RepositoryAbstract implements IContent
{
    
    public function entity()
    {
        return Content::class;
    }
    
    public function findByLesson($id){
        
        $content = Content::where('lesson_id', $id)->first();
        return $content;
    }
    
    
    public function deleteVideo($fileName)
    {
        
        if(config('site_settings.video_upload_location') == 'local' && \Storage::disk('server')->exists('videos/'.$fileName)){
            \Storage::disk('server')->delete('videos/'.$fileName);
        } elseif(config('site_settings.video_upload_location') == 's3' && Storage::disk('s3')->exists($fileName)){
            \Storage::disk('s3')->delete($fileName);
        }
    }
    
    public function createVideoContent(array $data, $lessonId)
    {
        $lesson = Lesson::find($lessonId);
        
        $content = $lesson->content()->create([
            'content_type' => $data['content_type'],
            'video_filename' => $data['video_filename'],
            'video_duration' => $data['video_duration'],
            'video_path' => $data['video_path'],
            'video_src' => $data['video_src'],
            'video_storage' => $data['video_storage'],
            'video_src' => 'upload'
        ]);
        
        return $content;
    }
    
    
    public function create(array $data)
    {
        $lesson = Lesson::find($data['lesson']);
        
        
        $content = $lesson->content()->create([
           'content_type' => 'article',
           'article_body' => $data['content'],
           'video_duration' => $this->calculateArticleReadingTime($data['content'])
        ]);
        
        return $content;
    }
    
    public function createYoutube(array $data)
    {
        $lesson = Lesson::find($data['lesson']);
        $content = $lesson->content()->create([
            'video_src' => 'embed',
            'content_type' => 'video',
            'video_provider' => 'youtube',
            'video_duration' => $data['duration'],
            'video_path' => $data['url']
        ]);
        
        return $content;
    }
    
    public function updateYoutube(array $data, $id)
    {
        $content = $this->find($id);
        $content->update([
            'video_duration' => $data['duration'],
            'video_path' => $data['url']
        ]);
        
        return $content;
    }
    
    public function update(array $data, $id)
    {
        $content = $this->find($id);
        $content->update([
           'article_body' => $data['content'],
           'video_duration' => $this->calculateArticleReadingTime($data['content'])
        ]);
        
        return $content;
    }
    
    public function updateDuration($id, $duration)
    {
        $content = $this->find($id);
        $content->video_duration = $duration;
        $content->save();
        
    }
    
    protected function calculateArticleReadingTime($text)
    {
        $word_count = str_word_count(strip_tags($text));
        $minutes = round($word_count / 200, 2);
        return $minutes;
    }
    
    
    
    
    
    
    
    
}