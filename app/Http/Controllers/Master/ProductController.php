<?php

namespace App\Http\Controllers\Master;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductImage;
use App\Models\ProductStock;
use App\Models\ProductVariantImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    // Helper function to retrieve all required data for forms (create/edit)
    private function getFormData()
    {
        return [
            'categories' => \App\Models\Category::where('status', 1)->get(),
            'units' => \App\Models\Unit::where('status', 1)->get(),
            'materials' => \App\Models\ProductMaterial::where('status', 1)->get(),
            'sizes' => \App\Models\ProductSize::where('status', 1)->get(),
            'colors' => \App\Models\ProductColor::where('status', 1)->get(),
        ];
    }
    private function uploadImages($images, $model, $directory)
    {
        if ($images && is_array($images)) {
            foreach ($images as $image) {
                if ($image instanceof \Illuminate\Http\UploadedFile) {
                    // Simpan gambar ke dalam folder '{directory}' yang dapat diakses publik
                    $imagePath = $image->store($directory, 'public'); // Gunakan 'public' sebagai disk

                    if ($model instanceof Product) {
                        ProductImage::create([
                            'product_id' => $model->id,
                            'image_path' => $imagePath,  // Misal: 'product_images/filename.jpg'
                            'is_main' => false, // Default as non-main
                        ]);
                    } elseif ($model instanceof ProductVariant) {
                        ProductVariantImage::create([
                            'product_variant_id' => $model->id,
                            'image' => $imagePath,
                        ]);
                    }
                }
            }
        }
    }

    public function destroyImage($imageId)
    {
        try {
            $image = ProductImage::findOrFail($imageId);
            Storage::disk('public')->delete($image->image_path); // Menghapus file dari storage
            $image->delete(); // Menghapus record dari database
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gambar tidak ditemukan'], 404);
        }
    }

    public function index(Request $request)
    {
        $filters = $request->only(['search', 'category', 'status']);
        $perPage = $request->get('perPage', 10);

        $products = Product::query()
            ->when($filters['search'] ?? false, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->when($filters['category'] ?? false, function ($query, $category) {
                return $query->where('category_id', $category);
            })
            ->when($filters['status'] ?? false, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->paginate($perPage);

        $categories = \App\Models\Category::where('status', 1)->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function show($slug)
    {
        // Mengambil data produk beserta relasinya
        $product = Product::with([
            'product_variants.product_variant_images',
            'product_variants.product_stocks',
            'product_variants.product_materials', // Corrected relationship name
            'product_variants.product_sizes',
            'product_variants.product_colors',
            'product_images',
            'categories',
            'units'
        ])->where('slug', $slug)->firstOrFail();

        // Ambil data tambahan untuk form (jika dibutuhkan di detail)
        $formData = $this->getFormData();

        // Struktur data untuk product_variants agar konsisten dengan edit
        $product_variants = $product->product_variants->map(function ($variant) {
            return [
                'id' => $variant->id,
                'product_id' => $variant->product_id,
                'material_id' => $variant->material_id,
                'size_id' => $variant->size_id,
                'color_id' => $variant->color_id,
                'price' => $variant->price,
                'product_variant_images' => $variant->product_variant_images,
                'product_stocks' => $variant->product_stocks,
            ];
        });

        // Kirim data ke view
        return view('admin.products.detail', [
            'product' => $product,
            'categories' => $formData['categories'],
            'units' => $formData['units'],
            'materials' => $formData['materials'],
            'sizes' => $formData['sizes'],
            'colors' => $formData['colors'],
            'product_images' => $product->product_images,
            'product_variants' => $product_variants,
        ]);
    }

    public function create()
    {
        $formData = $this->getFormData();
        return view('admin.products.create', $formData);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'model_number' => 'nullable|string|max:255',
                'name' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'unit_id' => 'required|exists:units,id',
                'default_price' => 'nullable|numeric|min:0',
                'default_stock' => 'nullable|integer|min:0',
                'status' => 'required|boolean',
                'meta_title' => 'nullable|string|max:255',
                'meta_keywords' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'is_featured' => 'nullable|boolean',
                'type' => 'nullable|string',
                'variations' => 'nullable|array',
                'variations.*.material_id' => 'required|exists:product_materials,id',
                'variations.*.size_id' => 'required|exists:product_sizes,id',
                'variations.*.color_id' => 'required|exists:product_colors,id',
                'variations.*.price' => 'required|numeric|min:0',
                'variations.*.stock' => 'required|integer|min:0',
                'variations.*.images' => 'nullable|array',
                'variations.*.images.*' => 'nullable|image|max:5120',
                'product_images' => 'nullable|array',
                'product_images.*' => 'nullable|image|max:5120',
                'cover' => 'nullable|image|max:5120',
            ]);

            // Create the product
            $product = Product::create([
                'category_id' => $validated['category_id'],
                'name' => $validated['name'],
                'slug' => Str::slug($validated['name']),
                'default_price' => $validated['default_price'] ?? 0,
                'default_stock' => $validated['default_stock'] ?? 0,
                'status' => $validated['status'],
                'unit_id' => $validated['unit_id'],
                'meta_title' => $validated['meta_title'] ?? $validated['name'],
                'meta_keywords' => $validated['meta_keywords'] ?? implode(',', explode(' ', $validated['name'])),
                'meta_description' => $validated['meta_description'] ?? substr($validated['description'] ?? $validated['name'], 0, 160),
                'description' => $validated['description'] ?? null,
                'type' => $validated['type'] ?? null,
                'is_featured' => $validated['is_featured'] ?? false,
                'model_number' => $validated['model_number'] ?? null,
            ]);

            // Handle product images upload
            if (isset($validated['product_images'])) {
                $this->uploadImages($validated['product_images'], $product, 'product_images');
            }

            // Handle product cover image upload
            if ($request->hasFile('cover')) {
                $coverPath = $request->file('cover')->store('product_images', 'public');  // Menyimpan di disk 'public'
                $product->cover = $coverPath; // Misal: 'product_images/filename.jpg'
                $product->save();
            }


            // Handle variations and their associated images
            if (isset($validated['variations'])) {
                foreach ($validated['variations'] as $variationData) {
                    $variant = ProductVariant::create([
                        'product_id' => $product->id,
                        'material_id' => $variationData['material_id'],
                        'size_id' => $variationData['size_id'],
                        'color_id' => $variationData['color_id'],
                        'price' => $variationData['price'],
                    ]);

                    // Handle stock for variant
                    ProductStock::create([
                        'product_variant_id' => $variant->id,
                        'stock' => $variationData['stock'],
                    ]);

                    // Handle images for variant
                    if (isset($variationData['images'])) {
                        $this->uploadImages($variationData['images'], $variant, 'product_variant_images');
                    }
                }
            }

            return redirect()->route('master.products.index')->with('success', 'Produk berhasil dibuat.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($slug)
    {
        // Retrieve product along with its variants and stock
        $product = Product::with('product_variants.product_variant_images', 'product_images', 'product_variants.product_stocks')->where('slug', $slug)->firstOrFail();

        // Get form data
        $formData = $this->getFormData();

        // Send product data, categories, units, materials, sizes, colors, and product variations with stock and images to view
        return view('admin.products.edit', [
            'product' => $product,
            'categories' => $formData['categories'],
            'units' => $formData['units'],
            'materials' => $formData['materials'],
            'sizes' => $formData['sizes'],
            'colors' => $formData['colors'],
            'product_images' => $product->product_images,
            'product_variants' => $product->product_variants->map(function ($variant) {
                return [
                    'id' => $variant->id,
                    'product_id' => $variant->product_id,
                    'material_id' => $variant->material_id,
                    'size_id' => $variant->size_id,
                    'color_id' => $variant->color_id,
                    'price' => $variant->price,
                    'product_variant_images' => $variant->product_variant_images,
                    'product_stocks' => $variant->product_stocks,
                ];
            }),
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            // Validasi input form
            $validated = $request->validate([
                'model_number' => 'nullable|string|max:255',
                'name' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'unit_id' => 'required|exists:units,id',
                'default_price' => 'nullable|numeric|min:0',
                'default_stock' => 'nullable|integer|min:0',
                'status' => 'required|boolean',
                'meta_title' => 'nullable|string|max:255',
                'meta_keywords' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'is_featured' => 'nullable|boolean',
                'type' => 'nullable|string',
                'variations' => 'nullable|array',
                'variations.*.material_id' => 'required|exists:product_materials,id',
                'variations.*.size_id' => 'required|exists:product_sizes,id',
                'variations.*.color_id' => 'required|exists:product_colors,id',
                'variations.*.price' => 'required|numeric|min:0',
                'variations.*.stock' => 'required|integer|min:0',
                'variations.*.images' => 'nullable|array',
                'variations.*.images.*' => 'nullable|image|max:5120',
                'product_images' => 'nullable|array',
                'product_images.*' => 'nullable|image|max:5120',
                'cover' => 'nullable|image|max:5120',
            ]);

            // Cari produk berdasarkan ID
            $product = Product::findOrFail($id);

            // Perbarui data produk
            $product->update($validated);

            // Menangani perubahan variasi produk
            if ($request->has('variations')) {
                foreach ($request->variations as $key => $variation) {
                    $productVariation = ProductVariant::find($variation['id']);
                    if ($productVariation) {
                        $productVariation->update([
                            'material_id' => $variation['material_id'],
                            'size_id' => $variation['size_id'],
                            'color_id' => $variation['color_id'],
                            'price' => $variation['price'],
                        ]);

                        // Menangani perubahan stok
                        if (isset($variation['stock'])) {
                            $productVariation->product_stocks()->update([
                                'stock' => $variation['stock'],
                            ]);
                        }

                        // Menangani perubahan gambar variasi produk
                        if (isset($variation['image']) && $variation['image']->isValid()) {
                            $imagePath = $variation['image']->store('product_variants', 'public');
                            $productVariation->product_variant_images()->updateOrCreate(
                                ['product_variant_id' => $productVariation->id],
                                ['image' => $imagePath]
                            );
                        }
                    }
                }
            }

            // Menangani gambar utama produk
            if ($request->hasFile('main_image')) {
                $mainImagePath = $request->file('main_image')->store('products_images', 'public');
                $product->product_images()->updateOrCreate(
                    ['product_id' => $product->id, 'is_main' => true],
                    ['image_path' => $mainImagePath]
                );
            }

            // Menangani galeri gambar produk
            if ($request->hasFile('product_images')) {
                foreach ($request->file('product_images') as $image) {
                    $imagePath = $image->store('product_gallery', 'public');
                    $product->product_images()->create([
                        'image_path' => $imagePath,
                        'is_main' => false,
                        'sort_order' => $product->product_images->count() + 1
                    ]);
                }
            }

            return redirect()->route('product.edit', $product->id)
                ->with('success', 'Produk berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }



    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);

            // Delete product images
            foreach ($product->product_images as $image) {
                // Menghapus 'public/' dari path jika sudah ada
                $imagePath = $image->image_path;  // Path relatif tanpa 'public/'
                Storage::delete('public/' . $imagePath);  // Hapus file dengan 'public/' prefix
                $image->delete();
            }

            // Delete variant images
            foreach ($product->product_variants as $variant) {
                foreach ($variant->product_variant_images as $variantImage) {
                    // Menghapus 'public/' dari path jika sudah ada
                    $variantImagePath = $variantImage->image;  // Path relatif tanpa 'public/'
                    Storage::delete('public/' . $variantImagePath);  // Hapus file dengan 'public/' prefix
                    $variantImage->delete();
                }

                // Hapus stok produk variant
                $variant->product_stocks()->delete();
                $variant->delete();
            }

            // Hapus cover image
            if ($product->cover) {
                $coverPath = $product->cover;  // Path relatif tanpa 'public/'
                Storage::delete('public/' . $coverPath);  // Hapus file dengan 'public/' prefix
            }

            // Hapus produk itu sendiri
            $product->delete();

            return redirect()->route('master.products.index')->with('success', 'Produk berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('master.products.index')->with('error', 'Gagal menghapus produk: ' . $e->getMessage());
        }
    }
}

