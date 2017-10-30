<?php

namespace App\Models\Concrete\Eloquent;

use App\Models\Concrete\AbstractEloquentRepository;
use App\Models\Contracts\Repositories\SubscriptionRepository;
use App\Models\Objects\Subscription;

class EloquentSubscriptionRepository extends AbstractEloquentRepository implements SubscriptionRepository
{
    protected $model;

    public function __construct(Subscription $model)
    {
        $this->model = $model;
    }
}