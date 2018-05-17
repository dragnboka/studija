<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }
}
