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
        return $this->model->get();
    }

    public function fabricAdmin($fabric_id_admin) {
        return $this->model->where('id', $fabric_id_admin)->get();
    }

}
