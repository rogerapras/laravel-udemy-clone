<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use App\Models\Traits\HasChildren;
use App\Models\Traits\IsOrderable;
use App\Models\Traits\HasLive;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasChildren, IsOrderable, HasLive, Uuid;
    
    protected $fillable=[
        'name', 'uuid', 'slug', 'image', 'live', 'parent_id', 'sortOrder'
    ];
    
    
    public function parent()
    {
        //return $this->belongsTo(self::class, 'parent_id', 'id');
        return $this->hasOne( Category::class, 'id', 'parent_id' );
    }
    
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
    
    
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
    
    /*********** Appends **************/
    protected $appends= [
        'course_count', 
        'url'
    ];
    
    public function getUrlAttribute()
    {
        return null;
        /*if(!$this->hasChildren()){
            $parent = Category::find($this->parent_id);
            return route('frontend.category', ['category' => $parent->slug, 'subcategory' => $this->slug]);
        }
        return route('frontend.category', ['category' => $this->slug]);*/
        
        
    }
    
    public function getCourseCountAttribute()
    {
        if($this->hasChildren()){
            $children = $this->children->pluck('id');
            $courses = Course::whereIn('category_id', $children)->count();
            return $courses;
        }
        return $this->courses->count();
    }
    
    
}
