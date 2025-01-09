<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductMaterial;
use App\Models\Setting;
use Illuminate\Http\Request;

class GuestController extends Controller
{

    public function index(Request $request)
    {
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
            'setting'
        ));
    }


    public function viewDetail($id)
    {
        $product = Product::findOrFail($id);
        // dd($product);
        $related_products = Product::where('is_featured', 1)->where('id', '!=', $product['id_product'])->where('category_id', $product['category_id'])->limit(8)->get();
        // dd($related_products);
        return view('guest.product', compact('product', 'related_products'));
    }
}
