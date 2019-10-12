<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuid;

class Attachment extends Model
{
    use Uuid;

    protected $fillable=[
        'uuid',
        'lesson_id',
        'file_name',
        'original_filename',
        'extension'
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
