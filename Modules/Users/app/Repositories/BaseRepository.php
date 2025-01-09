<?php

namespace Modules\Users\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $entity = $this->findById($id);
        if ($entity) {
            $entity->update($data);
            return true;
        }
        return false;
    }

    public function delete($id)
    {
        $entity = $this->findById($id);
        if ($entity) {
            $entity->delete(); // notice if need soft delete
            return true;
        }
        return false;
    }
}

