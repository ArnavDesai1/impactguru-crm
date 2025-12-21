<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->role === 'admin') {
            return $this->adminDashboard();
        } else {
            return $this->staffDashboard();
        }
    }

    private function adminDashboard()
    {
        $totalCustomers = Customer::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('amount');
        $totalUsers = User::count();
        $recentCustomers = Customer::latest()->take(5)->get();
        $recentOrders = Order::latest()->take(8)->get();
        $pendingOrders = Order::where('status', 'Pending')->count();
        $completedOrders = Order::where('status', 'Completed')->count();

        return view('dashboard.admin', compact(
            'totalCustomers',
            'totalOrders',
            'totalRevenue',
            'totalUsers',
            'recentCustomers',
            'recentOrders',
            'pendingOrders',
            'completedOrders'
        ));
    }

    private function staffDashboard()
    {
        $totalCustomers = Customer::count();
        $totalOrders = Order::count();
        $myOrders = Order::count(); // Staff can see all, but it's their responsibility
        $pendingOrders = Order::where('status', 'Pending')->count();
        $recentCustomers = Customer::latest()->take(5)->get();

        return view('dashboard.staff', compact(
            'totalCustomers',
            'totalOrders',
            'myOrders',
            'pendingOrders',
            'recentCustomers'
        ));
    }
}

