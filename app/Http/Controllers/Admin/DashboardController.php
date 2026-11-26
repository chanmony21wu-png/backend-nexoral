<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'revenue' => (float) Order::where('status', '!=', 'cancelled')->sum('total'),
            'orderCount' => Order::count(),
            'newCount' => Order::where('status', 'new')->count(),
            'productCount' => Product::count(),
            'byStatus' => Order::selectRaw('status, count(*) as n')->groupBy('status')->pluck('n', 'status'),
            'recent' => Order::withCount('items')->latest('id')->limit(5)->get(),
        ]);
    }
}