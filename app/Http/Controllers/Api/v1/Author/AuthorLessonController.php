<?php

namespace App\Http\Controllers\Api\v1\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ILesson;
use App\Repositories\Contracts\IContent;

class AuthorLessonController extends Controller
{
    
    protected $lessons;
    protected $contents;
    
    public function __construct(ILesson $lessons, IContent $contents)
    {
        $this->lessons = $lessons;
        $this->contents = $contents;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    
    public function findByCourse($id)
    {
        return $this->lessons->findByCourse($id);
    }
    
    public function findBySection($id)
    {
        return $this->lessons->findBySection($id);
    }
    
    
    public function updateDraggable(Request $request)
    {
        return $this->lessons->updateDraggable($request->all());
    }
    
    
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request, [
            'title' => 'required|max:70',
            'section' => 'required|numeric'
        ]);
        
        return $this->lessons->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->lessons->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $content = $this->contents->findByLesson($id);
        
        if($content){
            if($content->content_type=='video'){
                $currentVideo = $content->video_filename;
                $this->contents->deleteVideo($currentVideo);
            }
            $this->contents->destroy($content->id);
        }
        
        $this->lessons->destroy($id);
    }
}
