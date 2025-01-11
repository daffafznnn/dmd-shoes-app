<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductMaterial;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\Setting;
use Illuminate\Http\Request;


class GuestController extends Controller
{

    public function index(Request $request)
    {
        $isLoading = true;

        // Ambil kategori dan material yang aktif (status = 1)
        $categories = Category::where('status', 1)->get();
        $materials = ProductMaterial::where('status', 1)->get();
        $setting = Setting::first();

        // Query dasar untuk produk yang di-feature
        $featuredQuery = Product::where('is_featured', 1);

        // Filter berdasarkan keyword
        if ($request->filled('keyword')) {
            $featuredQuery->where(function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->keyword . '%')
                    ->orWhere('type', 'LIKE', '%' . $request->keyword . '%')
                    ->orWhere('description', 'LIKE', '%' . $request->keyword . '%');
            });
        }

        // Filter berdasarkan kategori
        if ($request->filled('category')) {
            $featuredQuery->where('category_id', $request->category);
        }

        // Filter berdasarkan material
        if ($request->filled('material')) {
            $featuredQuery->whereHas('product_variants', function ($q) use ($request) {
                $q->where('material_id', $request->material);
            });
        }

        // Ambil produk unggulan dengan pagination
        $featuredProducts = $featuredQuery->paginate(20);

        // Loading selesai untuk produk unggulan
        $isLoading = false;

        // Ambil produk berdasarkan tipe
        $menProducts = Product::where('type', 'man')->where('status', 1)->paginate(20);
        $womenProducts = Product::where('type', 'woman')->where('status', 1)->paginate(20);
        $unisexProducts = Product::where('type', 'unisex')->where('status', 1)->paginate(20);

        // Kirim data ke view
        return view('guest.index', compact(
            'categories',
            'materials',
            'featuredProducts',
            'menProducts',
            'womenProducts',
            'unisexProducts',
            'setting',
            'isLoading'
        ));
    }
    public function viewDetail($slug)
    {
        // Mengambil produk berdasarkan slug
        $product = Product::with([
            'product_variants.product_variant_images', // Mengambil gambar variasi produk
            'categories' // Mengambil kategori produk
        ])->where('slug', $slug)->firstOrFail();

        // Ambil data material, warna, dan ukuran yang aktif
        $materials = ProductMaterial::where('status', 1)->get();
        $colors = ProductColor::where('status', 1)->get();
        $sizes = ProductSize::where('status', 1)->get();

        // Mengambil semua variasi terkait produk
        $variants = $product->product_variants;

        // Jika kategori produk ada, ambil produk terkait berdasarkan kategori
        $relatedProducts = [];
        if ($product->categories) {
            $relatedProducts = Product::where('is_featured', 1)
                ->where('id', '!=', $product->id)
                ->where('category_id', $product->categories->id)
                ->limit(8)
                ->get();
        }
        $productVariants = $product->product_variants()->with(['product_materials', 'product_colors', 'product_sizes', 'product_variant_images'])->get();
        // Menghitung harga rentang terendah dan tertinggi dari variasi produk
        $priceRange = [
            'min' => $product->product_variants->min('price'),
            'max' => $product->product_variants->max('price')
        ];

        // Kirim data ke view
        return view('guest.product', compact('product', 'materials', 'colors', 'sizes', 'variants', 'relatedProducts', 'priceRange', 'productVariants'));
    }

    public function allProducts(Request $request)
    {
        $products = Product::where('status', 1);

        if ($request->filled('search')) {
            $products->where(function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->keyword . '%')
                    ->orWhere('type', 'LIKE', '%' . $request->keyword . '%')
                    ->orWhere('description', 'LIKE', '%' . $request->keyword . '%');
            });
        }

        if ($request->filled('category')) {
            $products->where('category_id', $request->category);
        }

        if ($request->filled('material')) {
            $products->whereHas('product_variants', function ($q) use ($request) {
                $q->where('material_id', $request->material);
            });
        }

        if ($request->filled('keyword')) {
            $products->where('type', $request->keyword);
        }

        if ($request->filled('is_featured')) {
            $products->where('is_featured', $request->is_featured);
        }

        $all_products = $products->paginate(1);

        return view('guest.all-products', compact('all_products'));
    }
}
