<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;



class ProductController extends Controller
{
    //
    public function getCateGory()
    {
        $category = Category::all();
        return response()->json($category);
    }

    public function getAllProducts()
    {
        $products = Product::with('productImage')->get();
        foreach ($products as $product) {
            foreach ($product->productImage as $image) {
                $image->img = asset($image->img);
            }
        }
        return  response()->json($products);
    }
    public function getProduct($id) {
        $product = Product::with(['productImage','productAttribute'])->where('id',$id)->first();
        foreach ($product->productImage as $image) {
            $image->img = asset($image->img);
        }
        return response()->json($product);
    }
}
