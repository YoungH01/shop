<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\AttributeProduct;
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
    public function attributeSplit($input)
    {
        $groups = explode(';', rtrim($input, ';'));

        $result = [];

        foreach ($groups as $group) {

            $group = trim($group, '()');
            
            $values = explode(',', $group);
            
            $result[] = [
                'color' => $values[0] ?? null,
                'size'  => $values[1] ?? null,
                'quantity' => (int)($values[2]) ?? null
            ];
        }
        return $result;
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
        $attributes = $this->attributeSplit($validated['quantity']);
        $total = array_sum(array_column($attributes, 'quantity'));
        $productData = [
            'title' => $validated['name_product'],
            'category' => $validated['category'],
            'descriptions' => $validated['descriptions'],
            'quantity' => $total,
            'new_price' => $validated['new_price'],
            'old_price' => $validated['old_price'],
            'sold' => 0
        ];
        // dd($productData);
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
        foreach ($attributes as &$item) {
            $item['product_id'] = $product->id;
            $item['quantity'] = (string)$item['quantity'];
            AttributeProduct::create($item);
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
        $product->productAttribute()->delete();
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
        $attributes = Product::with('productAttribute')->where('id',$id)->first();
        $arr=[];
        foreach($attributes->productAttribute as $item){
            $arr[]=[
                'color' => $item->color,
                'size' => $item->size,
                'quantity' => $item->quantity
            ];
        }
        // dd($arr);
        $formattedAttribute = implode(');(', array_map(function($item) {
            return implode(',', [
                $item['color'],
                $item['size'],
                $item['quantity']
            ]);
        }, $arr));
        $formattedAttribute = "($formattedAttribute)";
        $category = Category::all();
        return view('product.update', compact('product','category','formattedAttribute'));
    }

    /**
     * updateImplement function use for update product .
     *  @param id is id of product.
    */
    public function updateImplement(ProductRequest $request, $id)
    {
        $validated = $request->validated();
        $attributes = $this->attributeSplit($validated['quantity']);
        $total = array_sum(array_column($attributes, 'quantity'));
        $product = Product::findOrFail($id);
        $productData = [
            'title' => $validated['name_product'],
            'category' => $validated['category'],
            'descriptions' => $validated['descriptions'],
            'quantity' => $total,
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

        foreach ($attributes as &$attribute) {
            $existingAttribute = AttributeProduct::where('color', $attribute['color'])
                ->where('size', $attribute['size'])
                ->where('product_id', $id)
                ->first();
        
            if ($existingAttribute) {
                $existingAttribute->update([
                    'quantity' => (string)$attribute['quantity'],
                ]);
            } else {
                $attribute['product_id'] = $id;
                $attribute['quantity'] = (string)$attribute['quantity'];
                AttributeProduct::create($attribute);
            }
        }

        return redirect()->route('product.view');
    }
}   
