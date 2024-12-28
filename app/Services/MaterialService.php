<?php

namespace App\Services;

use App\Repositories\MaterialsRepository;
use Illuminate\Support\Str;

class MaterialService extends BaseService
{
  protected $message;

  public function __construct(MaterialsRepository $materialsRepository)
  {
    parent::__construct($materialsRepository);
  }

  public function create(array $data)
  {
    // Membuat slug berdasarkan nama material
    $data['slug'] = Str::slug($data['name']);

    // Cek apakah material sudah ada
    $existingMaterial = $this->repository->getModel()->where('name', $data['name'])->first();
    if ($existingMaterial) {
      // Set pesan error jika material sudah ada
      $this->message = 'Material dengan nama "' . $data['name'] . '" sudah ada.';
      return false;  // Mengembalikan false jika material sudah ada
    }

    // Jika material belum ada, lanjutkan membuat material baru
    parent::create($data);
    $this->message = 'Material berhasil dibuat.';
    return true;  // Mengembalikan true jika material berhasil dibuat
  }

  public function getMessage()
  {
    return $this->message;
  }

  public function search(array $filters = [], $perPage = 10)
  {
    return $this->repository->getModel()
      ->when(isset($filters['search']), function ($query) use ($filters) {
        $query->where('name', 'like', '%' . $filters['search'] . '%');
      })
      ->when(isset($filters['status']), function ($query) use ($filters) {
        $query->where('status', $filters['status']);
      })
      ->paginate($perPage);
  }
}

