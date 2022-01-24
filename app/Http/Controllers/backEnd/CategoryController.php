<?php

namespace App\Http\Controllers\backEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    
    public function showCategories()
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('backEnd.categories.viewCategories', compact('categories'));
    }

    public function createCategory()
    {
        $parent_cats = Category::where('is_parent', 1)->orderBy('title', 'ASC')->get();
        return view('backEnd.categories.createCategoryForm', compact('parent_cats'));
    }

    public function insertCategory(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:categories',
            'summary' => 'required|nullable',
            'is_parent' => 'sometimes|in:1',
            'parent_id' => 'nullable|exists:categories,id',
            'status' => 'nullable|in:active,inactive',
        ]);

        $data = $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count = Category::where('slug', $slug)->count();
        if($slug_count > 0) {
            $slug = time().'-'.$slug;
        }

        $data['slug'] = $slug;
        $data['is_parent'] = $request->input('is_parent', 0);
        // return $data;

        $status = Category::create($data);

        if($status) {
            return redirect('/admin/categories')->with('success', 'Category has been created successfully.');
        }else {
            return back()->with('error', 'Something went wrong!');
        }
    }

    public function editCategory($id) 
    {
        $category = Category::find($id);
        $parent_cats = Category::where('is_parent', 1)->orderBy('title', 'ASC')->get();
        
        if($category) {
            return view('backEnd.categories.editCategoryForm', compact('category', 'parent_cats'));
        }else {
            return back()->with('error', 'Data not found');
        }
    }

    public function updateCategory(Request $request, $id) 
    {
        $category = Category::find($id);

        if($category) {
            $request->validate([
                'title' => 'required',
                'summary' => 'required|nullable',
                'is_parent' => 'sometimes|in:1',
                'parent_id' => 'nullable|exists:categories,id',
                'status' => 'nullable|in:active,inactive',
            ]);
    
            $data = $request->all();
            $slug = Str::slug($request->input('title'));
            $slug_count = Category::where('slug', $slug)->count();
            if($slug_count > 0) {
                $slug = time().'-'.$slug;
            }
    
            $data['slug'] = $slug;

            if($request->is_parent ==1) {
                $data['parent_id'] = null;
            }

            $data['is_parent'] = $request->input('is_parent', 0);
            $status = $category->fill($data)->save();
    
            if($status) {
                return redirect('/admin/categories')->with('success', 'Category has been updated successfully.');
            }else {
                return back()->with('error', 'Something went wrong!');
            }
        }else {
            return back()->with('error', 'Data not found');
        }
       
    }

    public function deleteCategory($id) {
        $category = Category::find($id);
        $child_cat_id = Category::where('parent_id', $id)->pluck('id');

        if($category) {
            $status = $category->delete();
            if($status) {
                if(count($child_cat_id) > 0) {
                    Category::shiftChild($child_cat_id);
                }
                return redirect('/admin/categories')->with('success', 'Category has been deleted successfully.');
            } else {
                return back()->with('error', 'Something went wrong!');
            }
        }
    }

    public function categoryChangeStatus(Request $request) 
    {
        // dd($request->all());
        if($request->mode == 'true') {
            $id = $request->id;
            DB::table('categories')->where('id', $id)->update(['status' => 'active']);
        }else {
            $id = $request->id;
            DB::table('categories')->where('id', $id)->update(['status' => 'inactive']);
        }
        return response()->json(['message' => 'Status has been updated successfully.', 'status' => true]);
    }

    public function getChildByParentID(Request $request, $id)
    {
        $category = Category::find($request->id);
        
        if($category) {
            $child_id = Category::getChildByParentID($request->id);

            if(count($child_id) <= 0) {
                return response()->json(['status'=>false, 'data'=>null, 'message'=>'Category not found']);
            }

            return response()->json(['status' => true, 'data'=>$child_id, 'message'=>'Category can be found']);
        } else {
            return response()->json(['status'=>false, 'data'=>null, 'message'=>'Category not found']);
        }
    }
}
