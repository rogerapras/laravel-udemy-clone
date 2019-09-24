<?php

namespace App\Models;

use Spatie\Tags\HasTags;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;


class Course extends Model
{
    use Uuid, HasTags;

    protected $fillable = [
    	'user_id', 
    	'category_id', 
    	'title', 
    	'subtitle', 
    	'slug', 
    	'uuid',
    	'description', 
    	'language', 
    	'image', 
    	'level',
    	'featured', 
    	'price', 
    	'published', 
    	'approved'
    ];
    
    protected $appends=[
        'average_review',
        'total_reviews',
        'cover_image',
        'thumbnail',
        'total_video_hours',
        'total_minutes',
        'durationHMS',
        'total_articles',
        'short_description',
        'is_in_cart',
        'status_code',
        'sales_this_month',
        'total_sales',
        'total_hours',
        'total_lessons',
        'total_quizzes',
        'total_published_lessons',
        'total_students',
        'enrolled_this_month',
        'percent_completed',
        'price_discounted',
        'total_unanswered_questions'
    ];


    /******* RELATIONSHIPS ************/
    public function category()
    {
    	return $this->belongsTo(Category::class);
    }
    
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function sections()
    {
        return $this->hasMany(Section::class)->orderBy('sortOrder');
    }
    
    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'course_id');
    }
    
    public function requirements()
    {
        return $this->hasMany(CourseTarget::class)
            ->where('type', 'requirement')->orderBy('sortOrder', 'asc');
    }
    
    public function target_students()
    {
        return $this->hasMany(CourseTarget::class)
            ->where('type', 'target_student')->orderBy('sortOrder', 'asc');
    }
    
    public function what_to_learn()
    {
        return $this->hasMany(CourseTarget::class)
            ->where('type', 'what_to_learn')->orderBy('sortOrder', 'asc');
    }
    
    public function students()
    {
        return $this->belongsToMany(User::class, 'enrollments', 'course_id', 'user_id')->withTimestamps();
    }
    
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    
    public function approvals()
    {
        return $this->morphMany(Approval::class, 'approvable');
    }

    public function announcements()
    {
        return $this->belongsToMany(Announcement::class);
    }
    
    

    /********* APPENDS **********************/
    public function getPriceAttribute($value)
    {
        return (float)($value);
    }
    
    public function getPriceDiscountedAttribute()
    {
        $sitewide_coupon = Coupon::active()->isSitewide()->notExpired()->first();
        if(!is_null($sitewide_coupon)){
            $disc = $this->price - ($this->price * ($sitewide_coupon->percent/100.00));
            return $disc;
        }
        return false;
    }
    
    
    public function getPercentCompletedAttribute()
    {
        return auth()->check() ? auth()->user()->percentCompleted($this) : null;
    }
    
    public function getAverageReviewAttribute()
    {
        return round($this->reviews()->avg('rating'),1);
    }
    
    public function getTotalReviewsAttribute()
    {
        return $this->reviews()->count();
    }
    
    public function getTotalLessonsAttribute()
    {
        return Lesson::whereHas('section', function($q){
            $q->where('course_id', $this->id);
        })->count();
    }
    
    public function getTotalPublishedLessonsAttribute()
    {
        return Lesson::whereHas('section', function($q){
            $q->where('course_id', $this->id);
        })
        ->hasContent()
        ->count();
    }
    
    public function getTotalStudentsAttribute()
    {
        return $this->students()->count();
    }
    
    public function getEnrolledThisMonthAttribute()
    {
 
        $now = \Carbon\Carbon::now();
        $enrolled_this_month = $this->students()
                                    ->whereBetween('enrollments.created_at', [$now->startOfMonth() , $now->copy()->endOfMonth()])
                                    ->count('enrollments.id');
                                        
        return $enrolled_this_month;
    }

    public function getTotalUnansweredQuestionsAttribute()
    {
        return $this->questions()->doesntHave('comments')->count();
    }
    
    public function getIsInCartAttribute()
    {
        $cart = app('cart');
        if(!$cart || $cart->isEmpty()){
            return false;
        }
        
        $items = $cart->items()->pluck('product_id')->toArray();
        if(!in_array($this->id, $items)){
            return false;
        }
        
        return true;
        
        
    }
    
    public function getShortDescriptionAttribute()
    {
        return $this->description ? \Str::limit(strip_tags($this->description),250) : null;
    }
    
    public function getTotalHoursAttribute()
    {
        $q = \DB::table('sections')
            ->join('lessons', 'sections.id', '=', 'lessons.section_id')
            ->whereIn('lessons.content_type', ['video', 'article', 'youtube'])
            ->where('sections.course_id', '=', $this->id)
            ->sum('lessons.duration');

        $duration = round( $q/60, 1);    
        
        return $duration;
    }
    
    public function getTotalQuizzesAttribute()
    {
        $q = \DB::table('sections')
            ->join('lessons', 'sections.id', '=', 'lessons.section_id')
            ->where('lessons.content_type', '=', 'quiz')
            ->where('sections.course_id', '=', $this->id)
            ->count();
        
        return $q;
    }
    
    public function getTotalArticlesAttribute()
    {
        $q = \DB::table('sections')
            ->join('lessons', 'sections.id', '=', 'lessons.section_id')
            ->where('lessons.content_type', '=', 'article')
            ->where('sections.course_id', '=', $this->id)
            ->count();
        
        return $q;
    }
    
    public function getTotalVideoHoursAttribute()
    {
        $q = \DB::table('sections')
            ->join('lessons', 'sections.id', '=', 'lessons.section_id')
            ->whereIn('lessons.content_type', ['video', 'youtube'])
            ->where('sections.course_id', '=', $this->id)
            ->sum('lessons.duration');
        $time = round($q/60,1);
        return $time;
    }
    
    public function getTotalMinutesAttribute()
    {
        $q = \DB::table('sections')
            ->join('lessons', 'sections.id', '=', 'lessons.section_id')
            ->where('sections.course_id', '=', $this->id)
            ->sum('lessons.duration');

        return $q;
    }
    
    public function getDurationHMSAttribute()
    {
        return convert_minutes_to_duration($this->total_minutes);
    } 
    
    public function getCoverImageAttribute()
    {
        if($this->image){
            if(\Storage::disk('server')->exists('images/course/'.$this->image)){
                return '/uploads/images/course/'.$this->image;
            }
            return '/uploads/images/defaults/cover.jpg';
        } else {
            return '/uploads/images/defaults/cover.jpg';
        }
    }
    
    public function getThumbnailAttribute()
    {
        if($this->image){
            if(\Storage::disk('server')->exists('images/course/thumbnails/'.$this->image)){
                return '/uploads/images/course/thumbnails/'.$this->image;
            }
            return '/uploads/images/defaults/cover.jpg';
        } else {
            return '/uploads/images/defaults/cover.jpg';
        }
    }
    
    public function getSalesThisMonthAttribute()
    {
 
        $now = \Carbon\Carbon::now();
        $sales_earnings_this_month = Payment::where('course_id', $this->id)
                                        ->whereBetween('created_at', [$now->startOfMonth() , $now->copy()->endOfMonth()])
                                        ->sum('author_earning');
                                        
        return $sales_earnings_this_month;
    }
    
    public function getTotalSalesAttribute()
    {
        return Payment::where('course_id', $this->id)->sum('author_earning');
    }
    
    public function getStatusCodeAttribute()
    {
        if($this->approved && $this->published){
            return 'live';
        } elseif($this->approved && !$this->published){
            return 'unpublished';
        } elseif(!$this->approved && $this->published){
            return 'under_review';
        } elseif(!$this->approved && !$this->published){
            return 'draft';
        }
    }

    public function isLive()
    {
        return $this->approved && $this->published;
    }
   
}
