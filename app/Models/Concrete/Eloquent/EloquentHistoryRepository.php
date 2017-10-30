<?php

namespace App\Models\Concrete\Eloquent;

use App\Models\Concrete\AbstractEloquentRepository;
use App\Models\Contracts\Repositories\HistoryRepository;
use App\Models\Objects\History;

class EloquentHistoryRepository extends AbstractEloquentRepository implements HistoryRepository
{
    protected $model;

    public function __construct(History $model)
    {
        $this->model = $model;
    }
}