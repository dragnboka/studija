<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Filters\Study\SubjectFilters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Subject extends Model
{
    protected $dates = ['rodjen'];

    public function getAgeAttribute()
    {
        return  $this->rodjen->diff(Carbon::now())->format('%y');
    }
    
    public function getFormattedNameAttribute()
    {
        return mb_convert_case($this->ime, MB_CASE_TITLE, 'UTF-8');
    }

    public function getFormattedPolAttribute()
    {
        return $this->pol = ($this->pol == 'm' ? 'Muski' : 'Zenski');
    }

    public function getFormattedRodjenAttribute()
    {
        return $this->rodjen->toDateString();
    }

    public function scopeFilter(Builder $builder, Request $request)
    {
        return (new SubjectFilters($request))->filter($builder);
    }

    public function studies()
    {
        return $this->belongsToMany(Study::class);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    public function experiments()
    {
        return $this->hasMany(Experiment::class);
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class,'subject_task_comment')->withPivot('komentar');
    }
    
}

