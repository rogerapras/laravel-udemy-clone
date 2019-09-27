<?php
namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface IHome extends IRepository
{
    
    public function getMostViewedCourses();
    public function getTopCategories();
    public function getCategoryCourses($id);


    
}