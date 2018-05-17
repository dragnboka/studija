<?php

namespace App\Filters\Subject;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class TaskFilter extends FilterAbstract
{
    public function filter(Builder $builder, $value)
    {
        return $builder->whereHas('task', function (Builder $builder) use ($value) {
            $builder->where('name', $value);
        });
    }
}
