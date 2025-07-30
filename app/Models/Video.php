<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'title',
        'description',
        'file_path',
       
    ];

    public function courseModules()
    {
        return $this->belongsToMany(CourseModule::class, 'module_video', 'video_id', 'module_id');
    }

    public function challenges()
    {
        return $this->belongsToMany(Challenge::class);
    }
}
