<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Study extends Model
{
    use SoftDeletes;

    public function getRouteKeyName()
    {
        return 'slug';
    }
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
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
