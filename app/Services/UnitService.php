<?php

namespace App\Services;

use App\Repositories\UnitRepository;

class UnitService extends BaseService
{
  public function __construct(UnitRepository $unitRepository)
  {
    parent::__construct($unitRepository);
  }

  /**
   * Override create to include additional logic if necessary.
   */
  public function create(array $data)
  {
    // Additional logic before creation (if needed)
    return parent::create($data);
  }

  /**
   * Override update to include additional logic if necessary.
   */
  public function update($id, array $data)
  {
    // Additional logic before update (if needed)
    return parent::update($id, $data);
  }
}
