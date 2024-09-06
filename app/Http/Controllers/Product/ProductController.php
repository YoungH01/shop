<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * index function use for render list product.
     * 
    */
    public function index()
    {
        $products = Product::with(['productImage' => function ($query) {
            $query->where('is_main', true);
        }])->get();
        return view('product.display', compact('products'));
    }

     /**
     * addView function use for render add product form layout .
     * 
    */
    public function addView()
    {
        $category = Category::all();
        return view('product.add', compact('category'));
    }

    /**
     * addImplement function use for add product.
     * 
    */
    public function addImplement(ProductRequest $request)
    {
        $validated = $request->validated(); 
        $productData = [
            'title' => $validated['name_product'],
            'category' => $validated['category'],
            'descriptions' => $validated['descriptions'],
            'quantity' => $validated['quantity'],
            'new_price' => $validated['new_price'],
            'old_price' => $validated['old_price']
        ]; 
        $product = Product::create($productData);
        $imageData = [];
        if (isset($validated['images'])) { 
            foreach ($validated['images'] as $index => $file) {
                $extension = $file->getClientOriginalExtension();
                $filename = time() . $index . '.' . $extension;
                $pathImg = 'uploads/products/';
                $fullPath = public_path($pathImg); 
    
                $file->move($fullPath, $filename);
    
                $imageData[] = [
                    'product_id' => $product->id, 
                    'img' => $pathImg . $filename, 
                    'is_main' => $index == 0 ? true : false, 
                ];
            }
        }
        foreach ($imageData as $data) {
            ProductImage::create($data);
        }
        return redirect()->route('product.view');
    } 

    /**
     * removeProduct function use for remove Product .
     * @param id is id of product
    */
    public function removeProduct($id)
    {
        $product = Product::findOrFail($id);
        foreach($product->productImage as $image){
            $imagePath = public_path($image->img);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $product->productImage()->delete();
        $product->delete();
        return redirect()->route('product.view');
    }

    /**
     * updateView function use for render update product form layout .
     * @param id is id of product
    */
    public function updateView($id)
    {
        $product = Product::findOrFail($id);
        $category = Category::all();
        return view('product.update', compact('product','category'));
    }

    /**
     * updateImplement function use for update product .
     *  @param id is id of product.
    */
    public function updateImplement(ProductRequest $request, $id)
    {
        $validated = $request->validated(); 
        $product = Product::findOrFail($id);
        $productData = [
            'title' => $validated['name_product'],
            'category' => $validated['category'],
            'descriptions' => $validated['descriptions'],
            'quantity' => $validated['quantity'],
            'new_price' => $validated['new_price'],
            'old_price' => $validated['old_price']
        ]; 
        $product->update($productData);
        if ($request->has('delete_images')) {
            $deleteImageIds = $request->input('delete_images');
            foreach ($deleteImageIds as $imagePath) {
                ProductImage::where('img', $imagePath)->delete();
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        }
        if ($request->has('images')) {
            $imageData = [];
            if (isset($validated['images'])) { 
                foreach ($validated['images'] as $index => $file) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . $index . '.' . $extension;
                    $pathImg = 'uploads/products/';
                    $fullPath = public_path($pathImg); 
                    $file->move($fullPath, $filename);
                    $imageData[] = [
                        'product_id' => $product->id, 
                        'img' => $pathImg . $filename, 
                        'is_main' => $index == 0 ? true : false, 
                    ];
                }
            }
            foreach ($imageData as $data) {
                ProductImage::create($data);
            }
        }
        return redirect()->route('product.view');
    }
}   
