<?php

namespace App\Repositories;

use App\Models\Unit;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UnitRepository extends BaseRepository
{
  protected $rules = [
    'acronym' => 'required|string|max:10|unique:units,acronym',
    'name' => 'required|string|max:255',
    'status' => 'required|boolean',
    'is_base' => 'required|boolean',
  ];

  public function __construct(Unit $unit)
  {
    parent::__construct($unit);
  }

  /**
   * Create a new unit.
   */
  public function create(array $data)
  {
    $this->validate($data);

    return parent::create($data);
  }

  /**
   * Update an existing unit.
   */
  public function update($id, array $data)
  {
    $this->validate($data, $id);

    return parent::update($id, $data);
  }

  /**
   * Validate unit data.
   */
  protected function validate(array $data, $id = null)
  {
    $rules = $this->rules;

    // Modify acronym rule for updates
    if ($id) {
      $rules['acronym'] = 'required|string|max:10|unique:units,acronym,' . $id;
    }

    $validator = Validator::make($data, $rules);

    if ($validator->fails()) {
      throw new ValidationException($validator);
    }
  }
}

