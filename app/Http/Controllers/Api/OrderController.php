<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AttributeProduct;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index($id)
    {
        $dataOrder= Order::with(['orderDetails','orderDetails.product','user'])->where('user_id',$id)->get();
        return response()->json($dataOrder);
    }

    public function add(Request $request)
    {
        // return response()->json($request->cart);
        $dataOrder = [
            'user_id' => $request->user['id'],
            'name' => $request->user['name'],
            'address' => $request->user['address'],
            'phone' => $request->user['phone'],
            'total_price' => $request->totalPrice,
            'status' => 'done'
        ];
        $order = Order::create($dataOrder);
        $dataOrderDetail = [];
        foreach ($request->cart as $item) {
            $product = Product::where('id',$item['product_id'])->first();
            $product->sold += (int)$item['quantity'];
            $product->quantity -= (int)$item['quantity'];
            $product->save();
            $attribute = AttributeProduct::where('product_id',$item['product_id'])->where('size',$item['size'])->where('color',$item['color'])->first();
            $attribute->quantity = (string)((int)$attribute->quantity - (int)$item['quantity']);
            $attribute->save();
            $data = [
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'price' => (int)$item['total_price'],
                'base_price' => (int)$item['total_price']/(int)$item['quantity'],
                'name' => $product->title,
                'size' => $item['size'],
                'color' => $item['color'],
            ];
            $dataOrderDetail[] = $data;
        }
        foreach ($dataOrderDetail as $data) {
            OrderDetail::create($data);
        }
        return response()->json(['message' => 'payment success']);
    }
}
