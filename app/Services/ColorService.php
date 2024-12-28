<?php

namespace App\Services;

use App\Repositories\ColorRepository;
use Illuminate\Support\Str;

class ColorService extends BaseService
{
  protected $message;

  public function __construct(ColorRepository $colorRepository)
  {
    parent::__construct($colorRepository);
  }

  public function create(array $data)
  {
    // Membuat slug berdasarkan nama warna
    $data['slug'] = Str::slug($data['name']);

    // Cek apakah warna sudah ada
    $existingColor = $this->repository->getModel()->where('name', $data['name'])->first();
    if ($existingColor) {
      // Set pesan error jika warna sudah ada
      $this->message = 'Warna dengan nama "' . $data['name'] . '" sudah ada.';
      return false;  // Mengembalikan false jika warna sudah ada
    }

    // Jika warna belum ada, lanjutkan membuat warna baru
    parent::create($data);
    $this->message = 'Warna berhasil dibuat.';
    return true;  // Mengembalikan true jika warna berhasil dibuat
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

