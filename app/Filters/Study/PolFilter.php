<?php

namespace App\Filters\Study;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class PolFilter extends FilterAbstract
{
    /**
     * Mappings for database values.
     *
     * @return array
     */
    public function mappings()
    {
        return [
            'muski' => 'm',
            'zenski' => 'f',
        ];
    }

    /**
     * Filter by course access type (free, premium).
     *
     * @param  string $access
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function filter(Builder $builder, $value)
    {
        $value = $this->resolveFilterValue($value);

        if ($value === null) {
            return $builder;
        }

        return $builder->where('pol', $value);
    }
}
