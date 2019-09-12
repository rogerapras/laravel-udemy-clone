<?php

namespace App\Http\Controllers\Api\v1\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\IAuthorDashboard;

class AuthorDashboardController extends Controller
{
    protected $dashboard;

    public function __construct(IAuthorDashboard $dashboard)
    {
        $this->dashboard = $dashboard;
    }
    
    
    public function findAuthorCourses(Request $request)
    {
        $courses = $this->dashboard->findAuthorCourses($request->all());
        return response()->json($courses, 200);
    }
    
    public function findAuthorReviews(Request $request)
    {
        $reviews = $this->dashboard->findAuthorReviews($request->all());
        return response()->json($reviews, 200);
    }
    
}
