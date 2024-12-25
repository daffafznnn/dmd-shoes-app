<?php

namespace App\Repositories;

abstract class BaseRepository
{
  protected $model;

  public function __construct($model)
  {
    $this->model = $model;
  }

  public function getAll()
  {
    return $this->model->all();
  }

  public function getById($id)
  {
    return $this->model->find($id);
  }

  public function create(array $data)
  {
    return $this->model->create($data);
  }

  public function update($id, array $data)
  {
    $record = $this->model->find($id);

    if (!$record) {
      return null;
    }

    $record->update($data);
    return $record;
  }

  public function delete($id)
  {
    $record = $this->model->find($id);

    if (!$record) {
      return null;
    }

    return $record->delete();
  }
}
