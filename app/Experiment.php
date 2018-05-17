<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Filters\Subject\ExperimentFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Experiment extends Model
{
    public function scopeFilter(Builder $builder, Request $request)
    {
        return (new ExperimentFilters($request))->filter($builder);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
