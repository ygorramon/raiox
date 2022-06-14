<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submodule extends Model
{
    protected $fillable = [

        'description',

    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function queries()
    {
        return $this->hasMany(Query::class);
    }
}
