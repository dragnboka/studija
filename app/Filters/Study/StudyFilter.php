<?php

namespace App\Filters\Study;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class StudyFilter extends FilterAbstract
{
    public function filter(Builder $builder, $value)
    {
        return $builder->whereHas('studies', function (Builder $builder) use ($value) {
            $builder->where('name', $value);
        });
    }
}
