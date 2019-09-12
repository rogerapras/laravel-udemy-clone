<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use Uuid;
    
    protected $fillable=['uuid', 'title', 'objective', 'uuid', 'course_id', 'sortOrder'];
    
    protected $appends=['total_minutes', 'durationHMS'];
    
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    
    public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('sortOrder');
    }
    
    
    public function getTotalMinutesAttribute()
    {
        $minutes = $this->join('lessons', 'sections.id', '=', 'lessons.section_id')
                        ->join('contents', 'lessons.id', '=', 'contents.lesson_id')
                        ->where('sections.id', $this->id)
                        ->sum('contents.video_duration');
                        
        return $minutes;
    }
    
    public function getDurationHMSAttribute()
    {
        return convert_minutes_to_duration($this->total_minutes);
    } 

    
}
