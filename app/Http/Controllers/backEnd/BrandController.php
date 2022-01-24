<?php

namespace App\Http\Controllers\backEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function showBrands()
    {
        $brands = Brand::orderBy('id', 'DESC')->get();
        return view('backEnd.brands.viewBrands', compact('brands'));
    }

    public function createBrand()
    {
        return view('backEnd.brands.createBrandForm');
    }

    public function insertBrand(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:brands',
            'photo' => 'required',
            'status' => 'nullable|in:active,inactive',
        ]);

        $data = $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count = Brand::where('slug', $slug)->count();
        if($slug_count > 0) {
            $slug = time().'-'.$slug;
        }
        $data['slug'] = $slug;
        // return $data;

        $status = Brand::create($data);

        if($status) {
            return redirect('/admin/brands')->with('success', 'Brand has been created successfully.');
        }else {
            return back()->with('error', 'Something went wrong!');
        }
    }

    public function editBrand($id) 
    {
        $brand = Brand::find($id);
        
        if($brand) {
            return view('backEnd.brands.editBrandForm', compact('brand'));
        }else {
            return back()->with('error', 'Data not found');
        }
    }

    public function updateBrand(Request $request, $id) 
    {
        $brand = Brand::find($id);
        
        if($brand) {
            $request->validate([
                'title' => 'required',
                'photo' => 'required',
                'status' => 'nullable|in:active,inactive',
            ]);
    
            $data = $request->all();
            $slug = Str::slug($request->input('title'));
            $slug_count = Brand::where('slug', $slug)->count();
            if($slug_count > 0) {
                $slug = time().'-'.$slug;
            }
            $data['slug'] = $slug;
            $status = $brand->fill($data)->save();
    
            if($status) {
                return redirect('/admin/brands')->with('success', 'Brand has been updated successfully.');
            }else {
                return back()->with('error', 'Something went wrong!');
            }
        }else {
            return back()->with('error', 'Data not found');
        }
       
    }

    public function deleteBrand($id) {
        $brand = Brand::find($id);

        if($brand) {
            $status = $brand->delete();
            if($status) {
                return redirect('/admin/brands')->with('success', 'Brand has been deleted successfully.');
            } else {
                return back()->with('error', 'Something went wrong!');
            }
        }
    }


    public function brandChangeStatus(Request $request) 
    {
        if($request->mode == 'true') {
            $id = $request->id;
            DB::table('brands')->where('id', $id)->update(['status' => 'active']);
        }else {
            $id = $request->id;
            DB::table('brands')->where('id', $id)->update(['status' => 'inactive']);
        }
        return response()->json(['message' => 'Status has been updated successfully.', 'status' => true]);
    }
}
