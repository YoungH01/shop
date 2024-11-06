<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
     /**
     * index function use for render list order.
     * 
    */
    public function index()
    {
        $index = 0;
        $orderData = Order::with('orderDetails')->get();
        return view('order.display',compact('orderData','index'));
    }
}
