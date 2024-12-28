<?php

namespace App\Services;

use App\Repositories\UnitRepository;

class UnitService extends BaseService
{
    public function __construct(UnitRepository $unitRepository)
    {
        parent::__construct($unitRepository);
    }

    public function search(array $filters = [], $perPage = 10)
    {
        return $this->repository->getModel()
            ->when(isset($filters['search']), function ($query) use ($filters) {
                $query->where(function ($query) use ($filters) {
                    $query->where('name', 'like', '%' . $filters['search'] . '%')
                          ->orWhere('acronym', 'like', '%' . $filters['search'] . '%');
                });
            })
            ->when(isset($filters['status']), function ($query) use ($filters) {
                $query->where('status', $filters['status']);
            })
            ->paginate($perPage);
    }
}

