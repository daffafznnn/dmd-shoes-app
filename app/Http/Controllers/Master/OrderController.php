<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\PaymentMethod;
use App\Models\ShippingMethod;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     */
    public function index(Request $request)
    {   
        $isLoading = true;
        $search = $request->query('search'); // Ambil keyword pencarian
        $status = $request->query('status'); // Ambil filter status
        $trashed = $request->query('trashed'); // Ambil filter trashed

        // Query orders
        $orders = Order::with(['payment_methods', 'shipping_methods'])
        ->when($search, function ($query) use ($search) {
            $query->where('code_order', 'like', "%$search%")
            ->orWhere('customer_name', 'like', "%$search%");
        })
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->when($trashed, function ($query) {
                $query->onlyTrashed();
            })
            ->orderBy('created_at', 'desc') // Urutkan berdasarkan terbaru
            ->paginate(10); // Pagination

        $isLoading = false;

        return view('admin.orders.index', compact('orders', 'isLoading'));
    }

    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        $paymentMethods = PaymentMethod::where('is_active', 1)->get();
        $shippingMethods = ShippingMethod::where('is_active', 1)->get();
        $products = Product::with('product_variants')->get();
        $productsVariants = $products->pluck('product_variants')->flatten();

        return view('admin.orders.create', compact('paymentMethods', 'shippingMethods', 'products', 'productsVariants'));
    }

    /**
     * Store a newly created order in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_contact' => 'required|string|max:255',
            'shipping_address' => 'required|string',
            'note' => 'nullable|string',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'shipping_method_id' => 'required|exists:shipping_methods,id',
            'payment_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'tracking_number' => 'nullable|string|max:255',
            'status' => 'required|in:pending,processing,completed,cancelled',
            'order_details' => 'required|array',
            'order_details.*.product_id' => 'required|exists:products,id',
            'order_details.*.product_variant_id' => 'required|exists:product_variants,id',
            'order_details.*.quantity' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            $paymentProofPath = null;
            if ($request->hasFile('payment_proof')) {
                $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
            }

            $order = Order::create([
                'code_order' => 'ORD-' . time(),
                'customer_name' => $validatedData['customer_name'],
                'customer_contact' => $validatedData['customer_contact'],
                'shipping_address' => $validatedData['shipping_address'],
                'note' => $validatedData['note'],
                'payment_method_id' => $validatedData['payment_method_id'],
                'shipping_method_id' => $validatedData['shipping_method_id'],
                'payment_proof' => $paymentProofPath,
                'tracking_number' => $validatedData['tracking_number'],
                'status' => $validatedData['status'],
                'total' => 0,
            ]);

            $totalPrice = 0;

            $orderDetails = $validatedData['order_details'];

            foreach ($orderDetails as $detail) {
                $productVariant = ProductVariant::findOrFail($detail['product_variant_id']);
                $subTotal = $productVariant->price * $detail['quantity'];

                // Decrement stock
                $decrementStock = $productVariant->product_stocks->first();
                if ($decrementStock) {
                    if ($decrementStock->stock < $detail['quantity']) {
                        throw new \Exception('Stok produk tidak cukup untuk produk ' . ($productVariant->products->name ?? 'Unknown Product'));
                    }
                    $decrementStock->decrement('stock', $detail['quantity']);
                }

                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $productVariant->product_id,
                    'product_variant_id' => $productVariant->id,
                    'quantity' => $detail['quantity'],
                    'price' => $productVariant->price,
                    'sub_total' => $subTotal,
                ]);

                $totalPrice += $subTotal;
            }

            // Menghitung biaya pengiriman berdasarkan metode pengiriman
            $shippingCost = ShippingMethod::findOrFail($validatedData['shipping_method_id'])->cost;
            $totalPrice += $shippingCost * array_sum(array_column($orderDetails, 'quantity'));

            // Update total harga di order
            $order->update(['total' => $totalPrice]);

            DB::commit();

            return redirect()->route('master.orders.index')->with('success', 'Pesanan berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified order.
     */
    public function show($id)
    {
        $order = Order::with(['order_details.product_variant', 'payment_methods', 'shipping_methods'])->findOrFail($id);

        return view('admin.orders.detail', compact('order'));
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit($id)
    {
        $order = Order::with('order_details.products.product_variants')->whereNull('deleted_at')->findOrFail($id);
        $paymentMethods = PaymentMethod::all();
        $shippingMethods = ShippingMethod::all();
        $products = Product::with('product_variants')->get();
        $productsVariants = $products->pluck('product_variants')->flatten();

        if (!$order) {
            return redirect()->back()->with('error', 'Pesanan tidak dapat di edit karena sudah dihapus.');
        }

        return view('admin.orders.edit', compact('order', 'paymentMethods', 'shippingMethods', 'products', 'productsVariants'));
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_contact' => 'required|string|max:255',
            'shipping_address' => 'required|string',
            'note' => 'nullable|string',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'shipping_method_id' => 'required|exists:shipping_methods,id',
            'payment_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'tracking_number' => 'nullable|string|max:255',
            'status' => 'required|in:pending,processing,completed,cancelled',
            'order_details' => 'required|array',
            'order_details.*.product_id' => 'required|exists:products,id',
            'order_details.*.product_variant_id' => 'required|exists:product_variants,id',
            'order_details.*.quantity' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            $order = Order::findOrFail($id);
            $paymentProofPath = null;
            if ($request->hasFile('payment_proof')) {
                $paymentProofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
            } else {
                // Jika request payment_proof tidak ada, maka jangan di ekseskusi atau record nya di hilangkan
                $paymentProofPath = $order->payment_proof;
            }

            $order->update([
                'customer_name' => $validatedData['customer_name'],
                'customer_contact' => $validatedData['customer_contact'],
                'shipping_address' => $validatedData['shipping_address'],
                'note' => $validatedData['note'],
                'payment_method_id' => $validatedData['payment_method_id'],
                'shipping_method_id' => $validatedData['shipping_method_id'],
                'payment_proof' => $paymentProofPath,
                'tracking_number' => $validatedData['tracking_number'],
                'status' => $validatedData['status'],
                'total' => 0,
            ]);

            $totalPrice = 0;

            $orderDetails = $validatedData['order_details'];

            // Hapus detail order yang lama
            $order->order_details()->delete();
            $oldOrderDetails = $order->order_details->keyBy('product_variant_id')->toArray();
            
            foreach ($orderDetails as $detail) {
                $productVariant = ProductVariant::findOrFail($detail['product_variant_id']);
                $subTotal = $productVariant->price * $detail['quantity'];

                $oldOrderDetail = $oldOrderDetails[$productVariant->id] ?? null;

                if ($oldOrderDetail) {
                    // Increment stock berdasarkan perubahan quantity
                    $incrementStock = $oldOrderDetail['quantity'] - $detail['quantity'];
                    $productVariant->product_stocks->first()->increment('stock', $incrementStock);

                    // Update order detail
                    $oldOrderDetail->update([
                        'order_id' => $order->id,
                        'product_id' => $productVariant->product_id,
                        'product_variant_id' => $productVariant->id,
                        'quantity' => $detail['quantity'],
                        'price' => $productVariant->price,
                        'sub_total' => $subTotal,
                    ]);
                } else {
                    // Jika order detail yang lama tidak ada, maka decrement stock nya adalah quantity yang baru
                    $productVariant->product_stocks->first()->decrement('stock', $detail['quantity']);

                    // Buat data baru
                    OrderDetail::create([
                        'order_id' => $order->id,
                        'product_id' => $productVariant->product_id,
                        'product_variant_id' => $productVariant->id,
                        'quantity' => $detail['quantity'],
                        'price' => $productVariant->price,
                        'sub_total' => $subTotal,
                    ]);
                }

                $totalPrice += $subTotal;
            }

            // Menghitung biaya pengiriman berdasarkan metode pengiriman
            $shippingCost = ShippingMethod::findOrFail($validatedData['shipping_method_id'])->cost;
            $totalPrice += $shippingCost * array_sum(array_column($orderDetails, 'quantity'));

            // Update total harga di order
            $order->update(['total' => $totalPrice]);

            DB::commit();

            return redirect()->route('master.orders.index')->with('success', 'Pesanan berhasil diupdate.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    /**
     * Soft delete the specified order.
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        $order->delete(); // Soft delete

        return redirect()->route('master.orders.index')->with('success', 'Pesanan berhasil dipindahkan ke arsip.');
    }

    /**
     * Restore the soft deleted order.
     */
    public function restore($id)
    {
        $order = Order::onlyTrashed()->findOrFail($id);

        $order->restore();

        return redirect()->route('master.orders.index')->with('success', 'Pesanan berhasil dikembalikan.');
    }
    
    /**
     * Mengambil data variasi produk berdasarkan ID produk.
     * Jika produk tidak ditemukan, maka akan mengembalikan response kosong dengan status 404.
     *
     * @param int $product_id ID produk yang akan diambil variasinya
     * @return \Illuminate\Http\JsonResponse
     */
    public function getVariants($product_id)
    {
        $product = Product::find($product_id); // Ubah menjadi find() untuk menghindari exception

        if (!$product) {
            return response()->json([], 404); // Mengembalikan response kosong jika produk tidak ditemukan
        }

        // Mengambil varian produk dan menyertakan relasi terkait
        $variants = $product->product_variants->map(function ($variant) {
            // Periksa jika relasi ada, jika tidak, beri nilai default
            $productMaterials = $variant->product_materials ? $variant->product_materials->name : 'Unknown Material';
            $productColors = $variant->product_colors ? $variant->product_colors->name : 'Unknown Color';
            $productSizes = $variant->product_sizes ? [
                'size_number' => $variant->product_sizes->size_number ?? 'N/A',
                'size_chart' => $variant->product_sizes->size_chart ?? 'N/A',
            ] : ['size_number' => 'N/A', 'size_chart' => 'N/A'];

            return [
                'id' => $variant->id, // Menyertakan hanya ID
                'product_materials' => $productMaterials,
                'product_colors' => $productColors,
                'product_sizes' => $productSizes,
            ];
        });

        return response()->json($variants); // Mengembalikan semua data variasi
    }

    public function deleteProductInOrder($orderDetailId)
    {
        try {
            // Mencari order detail berdasarkan ID
            $orderDetail = OrderDetail::find($orderDetailId);

            if (!$orderDetail) {
                return response()->json(['message' => 'Detail order tidak ditemukan.'], 404);
            }

            $order = $orderDetail->orders;

            // Mengembalikan stock di product_stocks
            $productStock = $orderDetail->product_variant->product_stocks->first();
            if ($productStock) {
                $productStock->stock += $orderDetail->quantity;
                $productStock->save();
            }

            // Mengurangi total di order
            if ($order) {
                $order->total -= $orderDetail->sub_total;
                $order->save();
            }

            // Menghapus detail order
            $orderDetail->delete();

            return response()->json(['message' => 'Produk berhasil dihapus dari pesanan.']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

}

