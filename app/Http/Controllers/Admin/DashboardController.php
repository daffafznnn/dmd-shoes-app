<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Data untuk cards
        $totalUsers = User::count();
        $totalOrders = Order::count();
        $totalValue = Order::sum('total');
        $totalProducts = Product::count();

        // Data untuk Bar Chart (Pendapatan Bulanan)
        $barChartData = [
            'labels' => [],
            'data' => [],
            'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
            'borderColor' => 'rgba(75, 192, 192, 1)',
            'label' => 'Pendapatan Bulanan',
        ];

        $startOfYear = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();

        // Loop setiap bulan dalam tahun ini
        foreach (range(1, 12) as $month) {
            $startOfMonth = Carbon::createFromDate(null, $month, 1)->startOfMonth();
            $endOfMonth = Carbon::createFromDate(null, $month, 1)->endOfMonth();

            $monthlyRevenue = Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('total');

            $barChartData['labels'][] = $startOfMonth->format('F'); // Nama bulan
            $barChartData['data'][] = $monthlyRevenue; // Pendapatan bulan tersebut
        }

        // Data untuk Doughnut Chart
        $doughnutChartData = [
            'labels' => ['Pendapatan', 'Pesanan', 'Produk'],
            'data' => [$totalValue, $totalOrders, $totalProducts],
            'backgroundColor' => [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)'
            ],
            'borderColor' => [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)'
            ],
            'label' => 'Distribusi Statistik',
        ];

        // Kirim data ke view
        return view('admin.dashboard', compact('totalUsers', 'totalOrders', 'totalValue', 'totalProducts', 'barChartData', 'doughnutChartData'));
    }
}
