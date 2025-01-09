<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductMaterial;
use App\Models\Setting;
use App\Models\SocialSetting;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $materials = ProductMaterial::all();
        $setting = Setting::first();
        $social_setting = SocialSetting::all();

        if ($request->has('keyword')) {
            $products = Product::where('is_featured', 1)
                ->where('name', 'LIKE', '%' . $request->keyword . '%')
                ->orWhere('type', 'LIKE', '%' . $request->keyword . '%')
                ->orWhere('description', 'LIKE', '%' . $request->keyword . '%')
                ->paginate(20);
        } else if ($request->has('category')) {
            $products = Product::where('is_featured', 1)
                ->where('category_id', $request->category)
                ->paginate(20);
        } else if ($request->has('material')) {
            $products = Product::where('is_featured', 1)
                ->where('material_id', $request->material)->paginate(20);
        } else {
            $products = Product::where('is_featured', 1)->limit(20)->get();
        }
        return view('guest.index', compact('categories', 'materials', 'products', 'setting', 'social_setting'));
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
