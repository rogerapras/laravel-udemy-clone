<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use Uuid;
    
    protected $fillable = [
        'section_id', 
        'course_id',
        'title', 
        'content_type', 
        'uuid',
        'duration',
        'article_body',
        'description', 
        'preview', 
        'sortOrder'
    ];
    
    protected $appends=[ //'content_type', 
                            'durationHMS', 
                            'video_provider', 
                            'video_link', 
                            //'article_body', 
                            'minutes_seconds', 
                            'image',
                            'user_has_completed'
                        ];

    
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    
    public function video()
    {
        return $this->hasOne(Video::class);
    }

    public function content()
    {
        return $this->hasOne(Content::class);
    }
    
    public function completions()
    {
        return $this->belongsToMany(User::class, 'completions', 'lesson_id', 'user_id')->withTimestamps();
    }
    
    // public function getContentTypeAttribute()
    // {
    //     return $this->content ? $this->content->content_type : null;
    // }
    
    public function course()
    {
        return $this->belongsTo(Lesson::class, 'course_id');
    }
    
    public function getUserHasCompletedAttribute()
    {
        if(! auth()->check()){
            return false;
        }    
        
        return auth()->user()->hasCompletedLesson($this);
    }
    
    
    public function getDurationHMSAttribute()
    {
        
        if($this->duration){
            return convert_minutes_to_duration($this->duration);
        }
        
        return '00:00:00';
        
    }
    
    public function getVideoProviderAttribute()
    {
        
        if($this->content && $this->content->content_type == 'video'){
            if($this->content->video_provider){
                return $this->content->video_provider;
            } else {
                return 'mp4';
            }
        } else {
            return null;
        }
        
    }
    
    public function getImageAttribute()
    {
        return $this->section->course->cover_image;
    }
    
    public function getVideoLinkAttribute()
    {
        if($this->content && $this->content->content_type == 'video'){
            return $this->content->video_path;
        } else {
            return null;
        }
    }
    
    public function getMinutesSecondsAttribute()
    {
        if($this->content && $this->content->content_type == 'video' && $this->content->video_duration > 0){
            return gmdate("H:i:s", ($this->content->video_duration*60));
        } else {
            return null;
        }
    }
    
    // public function getArticleBodyAttribute()
    // {
    //     if($this->content && $this->content->content_type == 'article'){
    //         return $this->content->article_body;
    //     } else {
    //         return null;
    //     }
    // }
    
    
}

