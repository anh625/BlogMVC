<?php
namespace App\Repositories\Impl;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected Model $model;
    protected string $primaryKey = 'id';
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getById(string|int $id)
    {
        return $this->model->where($this->primaryKey, $id)->first();
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, string|int $id)
    {
        //dd($data);
        $record = $this->model->where($this->primaryKey, $id)->first();
        if (!$record) return null;
        $record->update($data);
        return $record;
    }

    public function delete(string|int $id)
    {
        $record = $this->model->where($this->primaryKey, $id)->first();
        if (!$record) return null;

        $record->delete();
        return $record;
    }
}
