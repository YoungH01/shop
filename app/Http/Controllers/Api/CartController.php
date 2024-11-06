<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index($id = null) {
        $cartItems = [];
        if (!Auth::guard('api')->user()) {
            $cartItems = Cart::with(['product','product.productImage'])->where('user_id', $id)->get();
        }else {
            $userID = Auth::guard('api')->user()->id;
            $cartItems = Cart::with('product')->where('user_id', $userID)->get();
        }
        foreach ($cartItems as $cartItem) {
            $productImage = $cartItem->product->productImage;
            foreach ($productImage as $image) {
                $image->img = asset($image->img);
            }
        }
        return response()->json($cartItems);
    }
    public function add(Request $request) {
        $dataCartItem = [
            'user_id' => $request->userId,
            'product_id' => $request->itemId,
            'quantity' => (string)($request->quantity),
            'total_price' => (string)($request->price),
            'size' => $request->size,
            'color' => $request->color,
        ];
        $cart = Cart::create($dataCartItem);
        return response()->json(['data' => $dataCartItem]);
    }
    public function remove($id) {
        Cart::where('id', $id)->delete();
        return response()->json(['message' =>  'success']);
    }
}
