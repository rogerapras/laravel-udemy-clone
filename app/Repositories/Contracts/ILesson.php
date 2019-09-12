<?php
namespace App\Repositories\Contracts;

interface ILesson extends IRepository
{
    
    public function findByCourse($id);
    public function findBySection($id);
    public function create(array $data);
    public function update(array $data, $id);
    public function findByUuid($uuid);
    public function markAsComplete($id);


}