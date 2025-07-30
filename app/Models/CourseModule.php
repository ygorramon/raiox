<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseModule extends Model
{
    protected $fillable = ['title', 'description'];

    public function videos()
    {
        return $this->belongsToMany(Video::class, 'module_video', 'module_id', 'video_id');    }
}
