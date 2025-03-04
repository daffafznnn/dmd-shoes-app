<?php

namespace App\Services;

abstract class BaseService
{
  protected $repository;

  public function __construct($repository)
  {
    $this->repository = $repository;
  }

  public function getAll()
  {
    return $this->repository->getAll();
  }

  public function getById($id)
  {
    return $this->repository->getById($id);
  }

  public function create(array $data)
  {
    return $this->repository->create($data);
  }

  public function update($id, array $data)
  {
    return $this->repository->update($id, $data);
  }

  public function delete($id)
  {
    return $this->repository->delete($id);
  }
}
