<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\IHome;
use App\Http\Resources\CourseResource;
use App\Http\Resources\CategoryResource;

class HomeController extends Controller
{

    protected $home;
    public function __construct(IHome $home)
    {
        $this->home = $home;
    }


    public function index()
    {
        //dd(extension_loaded('ctype'));
        // $requirements=[];
        // $requirements['storage/logs'] = ['status' => 'OK', 'message' => ''];
        // dd($requirements);

        $most_viewed = CourseResource::collection($this->home->getMostViewedCourses());
        $top_categories = $this->home->getTopCategories();
        $top_subcategories = CategoryResource::collection($this->home->getTopCategories('subcategory'));

        return view('frontend.index')
            ->with([
                'most_viewed' =>  $most_viewed,
                'top_categories' => $top_categories,
                'top_subcategories' => $top_subcategories
            ]);
    }

    
}
