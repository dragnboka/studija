<?php

namespace App\Filters\Study;

use App\Filters\FiltersAbstract;
use App\Study;

use App\Filters\Study\{
    PolFilter,
    NameFilter,
    StudyFilter,
    DobFilter 
};

class SubjectFilters extends FiltersAbstract
{
    /**
     * Default course filters.
     *
     * @var array
     */
    protected $filters = [
        'gender' => PolFilter::class,
        'name' => NameFilter::class,
        'study' => StudyFilter::class,
        'dob' => DobFilter::class,
    ];

    public static function mappings()
    {
        $map = [
            'gender' => [
                'male' => 'Male',
                'female' => 'Female'
            ],
            'name' => [
                'asc' => '+',
                'desc' => '-',
            ],
            'dob' => [
                'asc' => '+',
                'desc' => '-',
            ],
            'study' => Study::get()->pluck('name','name')->toArray()
           
        ];

        // if (auth()->check()) {
        //     $map = array_merge($map, [
        //         'started' => [
        //             'true' => 'Started',
        //             'false' => 'Not started',
        //         ]
        //     ]);
        // }

        return $map;
    }
}
