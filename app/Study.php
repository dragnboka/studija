<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    public function experiments()
    {
        return $this->hasManyThrough('App\Experiment', 'App\Task');
    }
}
