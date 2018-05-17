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
        'pol' => PolFilter::class,
        'ime' => NameFilter::class,
        'studija' => StudyFilter::class,
        'dob' => DobFilter::class,
    ];

    public static function mappings()
    {
        $map = [
            'pol' => [
                'muski' => 'Muski',
                'zenski' => 'Zenski'
            ],
            'ime' => [
                'asc' => 'asc',
                'desc' => 'desc',
            ],
            'dob' => [
                'asc' => 'asc',
                'desc' => 'desc',
            ],
            'studija' => Study::get()->pluck('name','name')->toArray()
           
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
