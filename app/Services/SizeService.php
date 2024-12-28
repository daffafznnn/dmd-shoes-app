<?php

namespace App\Services;

use App\Repositories\SizeRepository;
use Illuminate\Support\Str;

class SizeService extends BaseService
{
  protected $message;

  public function __construct(SizeRepository $sizeRepository)
  {
    parent::__construct($sizeRepository);
  }

  public function create(array $data)
  {
    // Membuat slug berdasarkan size_number
    $data['slug'] = Str::slug($data['size_number']);

    // Cek apakah ukuran sudah ada
    $existingSize = $this->repository->getModel()->where('size_number', $data['size_number'])->first();
    if ($existingSize) {
      // Set pesan error jika ukuran sudah ada
      $this->message = 'Ukuran "' . $data['size_number'] . '" sudah ada.';
      return false;  // Mengembalikan false jika ukuran sudah ada
    }

    // Jika ukuran belum ada, lanjutkan membuat ukuran baru
    parent::create($data);
    $this->message = 'Ukuran berhasil dibuat.';
    return true;  // Mengembalikan true jika ukuran berhasil dibuat
  }

  public function getMessage()
  {
    return $this->message;
  }

  public function search(array $filters = [], $perPage = 10)
  {
    return $this->repository->getModel()
      ->when(isset($filters['search']), function ($query) use ($filters) {
        $query->where('size_number', 'like', '%' . $filters['search'] . '%')
          ->orWhere('size_chart', 'like', '%' . $filters['search'] . '%')
          ->orWhere('slug', 'like', '%' . $filters['search'] . '%');
      })
      ->when(isset($filters['status']), function ($query) use ($filters) {
        $query->where('status', $filters['status']);
      })
      ->paginate($perPage); // Menambahkan paginasi
  }
}
