<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * index function render list category about name category and total product of category.
     * 
    */
    public function index()
    {
        $productByCategory = DB::table('category')
            ->leftJoin('products', 'category.name', '=', 'products.category')
            ->select('category.name', DB::raw('COUNT(products.category) as total'))
            ->whereNull('deleted_at')
            ->groupBy('category.name')
            ->get();
        return view('category.display', compact('productByCategory'));
    }

    /**
     * Remove function use for remove category.
     * @param category is name of category
    */
    public function remove($category)
    {
        Category::where('name',$category)->delete();
        return redirect()->route('category.view');
    }

    /**
     * addView function use for render  Add category form layout .
     * 
    */
    public function addView()
    {
        return view('category.add');
    }

    /**
     * addImplement function use for add category .
     * 
    */
    public function addImplement(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ],[
            'name.required' => 'Không được bỏ trống'
        ]);
        $categoryData = [
            'name' => $request->name
        ];
        Category::create($categoryData);
        return redirect()->route('category.view');
    }

    /**
     * updateView function use for render  Update category form layout .
     * @param category is name of category
    */
    public function updateView($category)
    {
        return view('category.update',['category' => $category]);
    }
    
    /**
     * updateImplement function use for update name of category .
     * @param category is name of category
     * 
    */
    public function updateImplement(Request $request, $category)
    {
        $request->validate([
            'name' => 'required',
        ],[
            'name.required' => 'Không được bỏ trống'
        ]);
        Category::where('name', $category)->update(['name' => $request->name]);
        Product::where('category', $category)->update(['category'=> $request->name]);
        return redirect()->route('category.view');
    }
}
