<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Filters\Study\SubjectFilters;
use App\Filters\Groups\SubjectFilters as GroupFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['rodjen','deleted_at'];

    public function getAgeAttribute()
    {
        return  $this->rodjen->diff(Carbon::now())->format('%y');
    }
    
    public function getFullNameAttribute()
    {
        return $this->ime . ' ' . $this->prezime;
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

    public function scopeGroupFilter(Builder $builder, Request $request)
    {
        return (new GroupFilter($request))->filter($builder);
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

