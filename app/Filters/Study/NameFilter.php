<?php

namespace App\Filters\Study;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class NameFilter extends FilterAbstract
{
    public function filter(Builder $builder, $direction)
    {
        return $builder->orderBy('ime', $this->resolveOrderDirection($direction));
    }
}
