<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    protected function validateProductData($request){
        return $request->validate([
            'name_product' => 'required',
            'category' => 'required',
            'new_price' => 'required',
            'old_price' => 'required',
            'descriptions' => 'required',
            'quantity' => 'required',
            'images.*' => 'required|image|mimes:png,jpg,jpeg,webp'
        ], [
            'name_product.required' => 'Không được bỏ trống',
            'category.required' => 'Không được bỏ trống',
            'new_price.required' => 'Không được bỏ trống',
            'old_price.required' => 'Không được bỏ trống',
            'descriptions.required' => 'Không được bỏ trống',
            'quantity.required' => 'Không được bỏ trống',
            'images.*.required' => 'Vui lòng chọn ít nhất một hình ảnh.',
            'images.*.image' => 'Tất cả các file phải là hình ảnh.',
            'images.*.mimes' => 'Chỉ chấp nhận các định dạng: png, jpg, jpeg, webp.',
        ]);
    }
    public function index(){
        $products = Product::with(['productImage' => function($query){
            $query->where('is_main',true);
        }])->get();
        return view('product.product',compact('products'));
    }
    public function addView(){
        $category = Category::all();
        return view('product.product_add',compact('category'));
    }
    public function addImplement(Request $request){
       $this->validateProductData($request);
        $productData = [
            'title' => $request->name_product,
            'category' => $request->category,
            'descriptions' => $request->descriptions,
            'quantity' => $request->quantity,
            'new_price' => $request->new_price,
            'old_price' => $request ->old_price
        ]; 
        $product = Product::create($productData);
        $imageData = [];
        if($files = $request->file('images')){
            foreach($files as $index => $file ){
                $extension= $file->getClientOriginalExtension();
                $filename= time() . $index . '.' . $extension;
                $pathImg = "uploads/products/";
                $file->move($pathImg,$filename);
                $imageData[] = [
                    'product_id'=> $product->id,
                    'img' => $pathImg .$filename, 
                    'is_main' => $index == 0 ? true :false,
                ];
            }
        }

        foreach ($imageData as $data) {
            ProductImage::create($data);
        }
        return redirect()->route('product.view');
    } 
    public function removeProduct($id){
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
    public function updateView($id){
        $product = Product::findOrFail($id);
        $category = Category::all();
        return view('product.product_update',compact('product','category'));
    }
    public function updateImplement(Request $request,$id){
        $this->validateProductData($request);
        $product = Product::findOrFail($id);
        $productData = [
            'title' => $request->name_product,
            'category' => $request->category,
            'descriptions' => $request->descriptions,
            'quantity' => $request->quantity,
            'new_price' => $request->new_price,
            'old_price' => $request ->old_price
        ]; 
        $product->update($productData);
        if ($request->has('delete_images')) {
            $deleteImageIds = $request->input('delete_images');
            foreach($deleteImageIds as $imagePath){
                ProductImage::where('img',$imagePath)->delete();
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        }
        if($request->has('images')){
            $imageData = [];
            if($files = $request->file('images')){
                foreach($files as $index => $file ){
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . $index . '.' . $extension;
                    $pathImg = "uploads/products/";
                    $file->move($pathImg,$filename);
                    $imageData[] =[
                        'product_id'=> $product->id,
                        'img' => $pathImg .$filename, 
                        'is_main' => false,
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
