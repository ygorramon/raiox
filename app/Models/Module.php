<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = [
       
        'description',
       
    ];

    public function submodules()
    {
        return $this->hasMany(Submodule::class);
    }
}
