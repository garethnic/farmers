<?php

namespace App\Models\Concrete\Eloquent;

use App\Models\Concrete\AbstractEloquentRepository;
use App\Models\Contracts\Repositories\CurrentYearRepository;
use App\Models\Objects\CurrentYear;

class EloquentCurrentYearRepository extends AbstractEloquentRepository implements CurrentYearRepository
{
    protected $model;

    public function __construct(CurrentYear $model)
    {
        $this->model = $model;
    }
}