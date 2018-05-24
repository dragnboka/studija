<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function experiments()
    {
        return $this->hasMany(Experiment::class);
    }

    public function subject()
    {
        return $this->belongsToMany(Subject::class,'subject_task_comment')->withPivot('komentar');
    }
}
