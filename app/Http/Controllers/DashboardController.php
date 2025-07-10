<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $totalcategories = Category::count();
        $totalorders = Order::where('order_status', '!=', 'Cancelled')->count();
        $pendingorders = Order::where('order_status', 'Pending')->count();
        return view('dashboard', compact('totalcategories', 'totalorders', 'pendingorders'));
    }
}
