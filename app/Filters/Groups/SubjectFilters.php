<?php

namespace App\Filters\Groups;

use App\Filters\FiltersAbstract;
use App\Groups;

use App\Filters\Groups\GroupFilter;

class SubjectFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'group' => GroupFilter::class,
    ];

    public static function mappings()
    {
        $map = [
            
            'task' => Study::get()->pluck('name','name')->toArray()
           
        ];

        return $map;
    }
}
