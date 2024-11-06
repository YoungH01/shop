<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //index function is render dashboard for admin
    public function index()
    {
        $totalPrice = Order::sum('total_price');
        $totalCustomer = User::where('role','customer')->count();
         return view('dashboard.display',compact('totalPrice','totalCustomer'));
    }

    // logout function use for logout for admin
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.layout');
    }
}
