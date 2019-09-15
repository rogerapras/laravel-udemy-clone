<?php

namespace App\Repositories\Eloquent;

use App\Models\Video;
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
        
        if(setting('site.video_upload_location') == 'local' && \Storage::disk('server')->exists('videos/'.$fileName)){
            \Storage::disk('server')->delete('videos/'.$fileName);
        } elseif(setting('site.video_upload_location') == 's3' && Storage::disk('s3')->exists($fileName)){
            \Storage::disk('s3')->delete($fileName);
        }
    }

    public function destroyVideo($id)
    {
        $video = Video::find($id);
        if($video) return $video->delete();
    }
    
    public function createVideoContent(array $data, $lessonId)
    {
        $lesson = Lesson::find($lessonId);
        $video = Video::updateOrCreate(
            ['lesson_id' => $lessonId],
            $data
        );
        $lesson->duration = $data['duration'];
        $lesson->content_type = 'video';
        $lesson->save();
        return $video;
    }
   
    
    public function createYoutube(array $data)
    {
        $lesson = Lesson::find($data['lesson']);

        Video::updateOrCreate(
            ['lesson_id' => $data['lesson']],
            [
                'disk' => 'youtube',
                'youtube_link' => $data['url'],
                'is_processed' => true
            ]
        );

        $lesson->duration = $data['duration'];
        $lesson->content_type = 'youtube';
        $lesson->save();
        return $lesson;
    }
    
    public function updateArticle(array $data) // check that ID is actually lesson ID
    {
        $lesson = Lesson::find($data['lesson']);
        $lesson->update([
           'content_type' => 'article',
           'article_body' => $data['content'],
           'duration' => $this->calculateArticleReadingTime($data['content'])
        ]);
        return $lesson;
    }
    
    public function updateDuration($id, $duration)
    {
        $lesson = Lesson::find($id)->update(['duration' => $duration]);
        
    }

    protected function calculateArticleReadingTime($text)
    {
        $word_count = str_word_count(strip_tags($text));
        $minutes = round($word_count / 200, 2);
        return $minutes;
    }
    
    
    
    
    
    
    
    
}