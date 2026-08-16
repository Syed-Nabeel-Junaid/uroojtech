<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard with basic catalog and customer statistics.
     */
    public function index(): View
    {
        return view('admin.dashboard', [
            'totalProducts' => Product::count(),
            'totalCategories' => Category::count(),
            'totalCustomers' => User::where('role', 'customer')->count(),
            'featuredProducts' => Product::where('featured', true)->count(),
        ]);
    }
}
