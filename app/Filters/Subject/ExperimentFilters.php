<?php

namespace App\Filters\Subject;

use App\Filters\FiltersAbstract;
use App\Study;

use App\Filters\Subject\{
    TaskFilter
};

class ExperimentFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'task' => TaskFilter::class,
    ];

    public static function mappings()
    {
        $map = [
            
            'task' => Study::get()->pluck('name','name')->toArray()
           
        ];

        return $map;
    }
}
