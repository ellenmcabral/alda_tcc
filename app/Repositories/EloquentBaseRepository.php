<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class EloquentBaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find(int $id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        $record = $this->model->find($id);

        if(!$record) {
            return false;
        }

        return $record->update($data);
    }

    public function delete(int $id)
    {
        $record = $this->model->find($id);

        if(!$record) {
            return false;
        }

        return $record->delete();
    }
}
