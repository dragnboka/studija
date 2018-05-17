<?php

namespace App;

use App\Filters\Study\SubjectFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $dates = ['rodjen'];

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
}

