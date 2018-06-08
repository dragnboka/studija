<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\Subject\ExperimentFilters;
use Illuminate\Database\Eloquent\SoftDeletes;

class Experiment extends Model
{
    use SoftDeletes;

    public $timestamps = false;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function time($vreme)
    {    
        return Carbon::createFromTimeString($vreme)->format('H:i'); 
        //return DateTime::createFromFormat('H:i:s', $vreme)->format('H:i');  
    }
    
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
