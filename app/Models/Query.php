<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Query extends Model
{
    protected $fillable = [

        'description',

    ];

    public function submodule()
    {
        return $this->belongsTo(Submodule::class);
    }
}
