<?php

namespace App\Filters\Groups;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class GroupFilter extends FilterAbstract
{
    public function filter(Builder $builder, $value)
    {
        return $builder->whereHas('groups', function (Builder $builder) use ($value) {
            $builder->where('name', $value);
        });
    }
}
