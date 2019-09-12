<?php
namespace App\Repositories\Contracts;

interface IContent extends IRepository
{
    
    public function findByLesson($id);
    public function createVideoContent(array $data, $lessonId);
    public function deleteVideo($fileName);
    public function create(array $data);
    public function update(array $data, $id);
    public function createYoutube(array $data);
    public function updateYoutube(array $data, $id);
    public function updateDuration($id, $duration);
    

}