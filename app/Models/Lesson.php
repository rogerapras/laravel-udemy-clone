<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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

    public function completions()
    {
        return $this->belongsToMany(User::class, 'completions', 'lesson_id', 'user_id')->withTimestamps();
    }
    

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    
    /********* SCOPE  ************************/
    public function scopeHasContent(Builder $builder)
    {
        return $builder->where(function($i) {
                $i->orWhere(function($j){
                    $j->where('content_type', 'article')
                        ->whereNotNull('article_body');
                })
                ->orWhere(function($k){
                    $k->where('content_type', 'video')
                        ->whereHas('video', function($l){
                            $l->whereNotNull('streamable_sm')
                                ->where('is_processed', 1)
                                ->where('processing_succeeded', 1);
                        });
                })
                ->orWhere(function($m){
                    $m->where('content_type', 'youtube')
                        ->whereHas('video', function($n){
                            $n->whereNotNull('youtube_link');
                        });
                });
            });
    }

    public function scopeDoesntHaveContent(Builder $builder)
    {
        return $builder->where(function($i) {
                $i->orWhere(function($j){
                    $j->where('content_type', 'article')
                        ->whereNull('article_body');
                })
                ->orWhere(function($k){
                    $k->where('content_type', 'video')
                        ->whereHas('video', function($l){
                            $l->orWhereNull('streamable_sm')
                                ->orWhere('is_processed', 0)
                                ->orWhere('processing_succeeded', 0);
                        });
                })
                ->orWhere(function($m){
                    $m->where('content_type', 'youtube')
                        ->whereHas('video', function($n){
                            $n->whereNull('youtube_link');
                        });
                });
            });
    }

    
    /*********** APPENDS ****************************/
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
        
        if($this->content_type == 'video'){
            return 'mp4';
        }elseif($this->content_type == 'youtube'){
            return 'youtube';
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
        if($this->content_type == 'video' && $this->video){
            return $this->video->streamable_sm;
        } elseif($this->content_type == 'youtube' && $this->video){
            return $this->video->youtube_link;
        } else {
            return null;
        }
    }
    
    public function getMinutesSecondsAttribute()
    {
        return gmdate("H:i:s", ($this->duration*60));
    }
    
    
    
}

