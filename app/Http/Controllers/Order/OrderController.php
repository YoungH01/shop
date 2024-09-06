<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
     /**
     * index function use for render list order.
     * 
    */
    public function index(){
        return view('order.display');
    }
}
