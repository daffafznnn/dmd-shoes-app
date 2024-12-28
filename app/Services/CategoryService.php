<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Illuminate\Support\Str;

class CategoryService extends BaseService
{
  protected $message;

  public function __construct(CategoryRepository $categoryRepository)
  {
    parent::__construct($categoryRepository);
  }

  public function create(array $data)
  {
    // Membuat slug berdasarkan nama kategori
    $data['slug'] = Str::slug($data['name']);

    // Cek apakah kategori sudah ada
    $existingCategory = $this->repository->getModel()->where('name', $data['name'])->first();
    if ($existingCategory) {
      // Set pesan error jika kategori sudah ada
      $this->message = 'Kategori dengan nama "' . $data['name'] . '" sudah ada.';
      return false;  // Mengembalikan false jika kategori sudah ada
    }

    // Jika kategori belum ada, lanjutkan membuat kategori baru
    parent::create($data);
    $this->message = 'Kategori berhasil dibuat.';
    return true;  // Mengembalikan true jika kategori berhasil dibuat
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
