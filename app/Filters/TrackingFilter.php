<?php

namespace App\Filters;

class TrackingFilter extends QueryFilter
{
    public function code($value = null)
    {
        return $this->builder->where('code', 'ilike', "%$value%");
    }

    public function delivered($value = null)
    {
        return $this->builder->where('delivered', 'ilike', "%$value%");
    }
}
