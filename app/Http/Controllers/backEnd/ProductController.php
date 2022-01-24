<?php

namespace App\Http\Controllers\backEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductAttribute;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    public function showProducts()
    {
        $products = Product::orderBy('id', 'DESC')->get();
        return view('backEnd.products.viewProducts', compact('products'));
    }

    public function createProduct()
    {
        $categories = Category::where('status', '=', 'active')
        ->where('is_parent', '=', 1)
        ->orderBy('title', 'ASC')
        ->get();

        $brands = Brand::where('status', '=', 'active')
        ->orderBy('title', 'ASC')
        ->get();
        return view('backEnd.products.createProductForm', compact('categories', 'brands'));

    }

    public function insertProduct(Request $request)
    {
        $request->validate([
            'title' => 'required|string|unique:Products',
            'summary' => 'required|string|nullable',
            'description' => 'required|string|nullable',
            'additional_info' => 'required|string|nullable',
            'return_cancellation' => 'required|string|nullable',
            'stock' => 'required|nullable|numeric',
            'price' => 'required|nullable|numeric',
            'discount' => 'required|nullable|numeric',
            'photo' => 'required',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'child_cat_id' => 'nullable|exists:categories,id',
            'size' => 'required|nullable',
            'conditions' => 'required|nullable',
            'status' => 'required|nullable|in:active,inactive',
        ]);

        $data = $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count = Product::where('slug', $slug)->count();
        if($slug_count > 0) {
            $slug = time().'-'.$slug;
        }
        $data['slug'] = $slug;

        $data['offer_price'] = ($request->price - (($request->price * $request->discount)/100));
       
        $status = Product::create($data);
        if($status) {
            return redirect('/admin/products')->with('success', 'Product has been created successfully.');
        }else {
            return back()->with('error', 'Something went wrong!');
        }
    }


    public function editProduct($id) 
    {
        $product = Product::find($id);

        $categories = Category::where('status', '=', 'active')
        ->where('is_parent', '=', 1)
        ->orderBy('title', 'ASC')
        ->get();

        $brands = Brand::where('status', '=', 'active')
        ->orderBy('title', 'ASC')
        ->get();
        
        if($product) {
            return view('backEnd.products.editProductForm', compact('product', 'categories', 'brands'));
        }else {
            return back()->with('error', 'Data not found');
        }
    }

    public function updateProduct(Request $request, $id) 
    {
        $product = Product::find($id);
        
        if($product) {
            $request->validate([
                'title' => 'required|string',
                'summary' => 'required|string|nullable',
                'description' => 'required|string|nullable',
                'additional_info' => 'required|string|nullable',
                'return_cancellation' => 'required|string|nullable',
                'stock' => 'required|nullable|numeric',
                'price' => 'required|nullable|numeric',
                'discount' => 'required|nullable|numeric',
                'photo' => 'required',
                'size_guide' => 'nullable',
                'brand_id' => 'required|exists:brands,id',
                'category_id' => 'required|exists:categories,id',
                'child_cat_id' => 'nullable|exists:categories,id',
                'size' => 'required|nullable',
                'conditions' => 'required|nullable',
                'status' => 'required|nullable|in:active,inactive',
            ]);
    
    
            $data = $request->all();
            $data = $request->all();
            $slug = Str::slug($request->input('title'));
            $slug_count = Product::where('slug', $slug)->count();
            if($slug_count > 0) {
                $slug = time().'-'.$slug;
            }
            $data['slug'] = $slug;

            $data['offer_price'] = ($request->price - (($request->price * $request->discount)/100));
            $status = $product->fill($data)->save();
    
            if($status) {
                return redirect('/admin/products')->with('success', 'Product has been updated successfully.');
            }else {
                return back()->with('error', 'Something went wrong!');
            }
        }else {
            return back()->with('error', 'Data not found');
        }
       
    }

    public function deleteProduct($id) {
        $product = Product::find($id);

        if($product) {
            $status = $product->delete();
            if($status) {
                return redirect('/admin/products')->with('success', 'product has been deleted successfully.');
            } else {
                return back()->with('error', 'Something went wrong!');
            }
        }
        else {
            return back()->with('error', 'Data not found!');
        }
    }


    public function productChangeStatus(Request $request) 
    {
        // dd($request->all());
        if($request->mode == 'true') {
            $id = $request->id;
            DB::table('products')->where('id', $id)->update(['status' => 'active']);
        }else {
            $id = $request->id;
            DB::table('products')->where('id', $id)->update(['status' => 'inactive']);
        }
        return response()->json(['message' => 'Status has been updated successfully.', 'status' => true]);
    }

    
    //Product Attribute 
    public function showProductAttribute($id) 
    {
        $product = Product::find($id);
        $productAttribute = ProductAttribute::where('product_id', $id)->orderBy('id', 'DESC')->get();
        

        $categories = Category::where('status', '=', 'active')
        ->where('is_parent', '=', 1)
        ->orderBy('title', 'ASC')
        ->get();

        $brands = Brand::where('status', '=', 'active')
        ->orderBy('title', 'ASC')
        ->get();
        
        if($product) {
            return view('backEnd.products.productAttribute', compact('product', 'categories', 'brands', 'productAttribute'));
        }else {
            return back()->with('error', 'Data not found!');
        }
    }

    public function addProductAttribute(Request $request, $id)
    {
        // $request->validate([
        //     'size' => 'nullable|string',
        //     'original_price' => 'nullable|numeric',
        //     'offer_price' => 'nullable|numeric',
        //     'stock' => 'nullable|numeric',
        // ]);

        $data = $request->all();


        foreach($data['original_price'] as $key=>$val) {
            if(!empty($val)) {
                $attribute = new ProductAttribute();
                $attribute['original_price'] = $val;
                $attribute['offer_price'] = $data['offer_price'][$key];
                $attribute['stock'] = $data['stock'][$key];
                $attribute['product_id'] = $id;
                $attribute['size'] = $data['size'][$key];
                $attribute->save();
            }
        }

        return redirect()->back()->with('success', 'Product attribute has been added successfully.');
    }

    public function deleteProductAttribute($id) {
        $productAttribute = ProductAttribute::find($id);

        if($productAttribute) {
            $status = $productAttribute->delete();
            if($status) {
                return redirect()->back()->with('success', 'product attribute has been deleted successfully.');
                // return redirect('/admin/productsAttribute/add/{id}')->with('success', 'product attribute has been deleted successfully.');
            } else {
                return back()->with('error', 'Something went wrong!');
            }
        }
        else {
            return back()->with('error', 'Data not found!');
        }
    }


}
