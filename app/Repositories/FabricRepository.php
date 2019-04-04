<?php namespace App\Repositories;

use App\Fabric;

class FabricRepository extends Repository
{
    public function __construct(Fabric $model)
    {
        parent::__construct($model);
    }

    public function allFabrics()
    {
        return $this->model->orderBy('name', 'asc')->get();
    }

}
