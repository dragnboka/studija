<?php

namespace App\Filters\Study;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class DobFilter extends FilterAbstract
{
    public function filter(Builder $builder, $direction)
    {
        return $builder->orderBy('rodjen', $this->resolveOrderDirection($direction));
    }
}
