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

        $categories = \App\Models\Category::all();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::with('product_variants.product_variant_images', 'product_images')->where('slug', $slug)->firstOrFail();
        return view('admin.products.detail', compact('product'));
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
                'default_price' => 'required|numeric|min:0',
                'default_stock' => 'required|integer|min:0',
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
                'variations.*.images.*' => 'nullable|image|max:2048',
                'images' => 'nullable|array',
                'images.*' => 'nullable|image|max:2048',
                'cover' => 'nullable|image|max:2048',
            ]);

            // Create the product
            $product = Product::create([
                'category_id' => $validated['category_id'],
                'name' => $validated['name'],
                'slug' => Str::slug($validated['name']),
                'default_price' => $validated['default_price'],
                'default_stock' => $validated['default_stock'],
                'status' => $validated['status'],
                'unit_id' => $validated['unit_id'],
                'meta_title' => $validated['meta_title'] ?? null,
                'meta_keywords' => $validated['meta_keywords'] ?? null,
                'meta_description' => $validated['meta_description'] ?? null,
                'description' => $validated['description'] ?? null,
                'type' => $validated['type'] ?? null,
                'is_featured' => $validated['is_featured'] ?? false,
                'model_number' => $validated['model_number'] ?? null,
            ]);

            // Handle product images
            if (isset($validated['images'])) {
                foreach ($validated['images'] as $image) {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $image->store('public/product_images'),
                    ]);
                }
            }

            // Handle product cover image
            if ($request->hasFile('cover')) {
                $product->cover = $request->file('cover')->store('public/product_images');
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
                        foreach ($variationData['images'] as $image) {
                            ProductVariantImage::create([
                                'product_variant_id' => $variant->id,
                                'image' => $image->store('public/product_variant_images'),
                            ]);
                        }
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
        $product = Product::with('product_variants.product_variant_images', 'product_images')->where('slug', $slug)->firstOrFail();
        $formData = $this->getFormData();
        return view('admin.products.edit', compact('product', 'formData'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                    'name' => 'required|string|max:255',
                    'category_id' => 'required|exists:categories,id',
                    'unit_id' => 'required|exists:units,id',
                    'default_price' => 'required|numeric|min:0',
                    'default_stock' => 'required|integer|min:0',
                    'status' => 'required|boolean',
                    'meta_title' => 'nullable|string|max:255',
                    'meta_keywords' => 'nullable|string|max:255',
                    'meta_description' => 'nullable|string|max:255',
                    'type' => 'nullable|string|max:255',
                    'description' => 'nullable|string|max:255',
                    'is_featured' => 'nullable|boolean',
                    'variations' => 'nullable|array',
                    'variations.*.id' => 'nullable|exists:product_variants,id',
                    'variations.*.material_id' => 'required|exists:product_materials,id',
                    'variations.*.size_id' => 'required|exists:product_sizes,id',
                    'variations.*.color_id' => 'required|exists:product_colors,id',
                    'variations.*.price' => 'required|numeric|min:0',
                    'variations.*.stock' => 'required|integer|min:0',
                    'variations.*.images' => 'nullable|array',
                    'variations.*.images.*' => 'nullable|image|max:2048',
                ]);

            $product = Product::findOrFail($id);
            $product->update([
                'name' => $validated['name'],
                'category_id' => $validated['category_id'],
                'unit_id' => $validated['unit_id'],
                'default_price' => $validated['default_price'],
                'default_stock' => $validated['default_stock'],
                'status' => $validated['status'],
                'meta_title' => $validated['meta_title'] ?? null,
                'meta_keywords' => $validated['meta_keywords'] ?? null,
                'meta_description' => $validated['meta_description'] ?? null,
                'type' => $validated['type'] ?? null,
                'description' => $validated['description'] ?? null,
                'is_featured' => $validated['is_featured'] ?? false,
            ]);

            // Handle images
            if (isset($validated['images'])) {
                foreach ($validated['images'] as $image) {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $image->store('public/product_images'),
                    ]);
                }
            }

            // Handle variations and their associated images
            if (isset($validated['variations'])) {
                foreach ($validated['variations'] as $variationData) {
                    $variant = ProductVariant::updateOrCreate(
                        ['id' => $variationData['id'] ?? null, 'product_id' => $product->id],
                        [
                            'material_id' => $variationData['material_id'],
                            'size_id' => $variationData['size_id'],
                            'color_id' => $variationData['color_id'],
                            'price' => $variationData['price'],
                        ]
                    );

                    // Update stock for variant
                    ProductStock::updateOrCreate(
                        ['product_variant_id' => $variant->id],
                        ['stock' => $variationData['stock']]
                    );

                    // Handle images for variant
                    if (isset($variationData['images'])) {
                        foreach ($variationData['images'] as $image) {
                            ProductVariantImage::create([
                                'product_variant_id' => $variant->id,
                                'image' => $image->store('public/product_variant_images'),
                            ]);
                        }
                    }
                }
            }

            return redirect()->route('master.products.index')->with('success', 'Produk berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);

            // Delete product images and variant images
            foreach ($product->product_images as $image) {
                Storage::delete($image->image_path);
                $image->delete();
            }

            foreach ($product->product_variants as $variant) {
                foreach ($variant->product_variant_images as $variantImage) {
                    Storage::delete($variantImage->image);
                    $variantImage->delete();
                }
                $variant->product_stocks()->delete();
                $variant->delete();
            }

            $product->delete();

            return redirect()->route('master.products.index')->with('success', 'Produk berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('master.products.index')->with('error', 'Gagal menghapus produk: ' . $e->getMessage());
        }
    }
}

