<?php

namespace App\Http\Controllers\backEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class BannerController extends Controller
{
    public function showBanners()
    {
        $banners = Banner::orderBy('id', 'DESC')->get();
        return view('backEnd.banners.viewBanners', compact('banners'));
    }

    public function createBanner()
    {
        return view('backEnd.banners.createBannerForm');
    }

    public function insertBanner(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:banners',
            'description' => 'required|nullable',
            'photo' => 'required',
            'condition' => 'nullable|in:banner,promotional',
            'status' => 'nullable|in:active,inactive',
        ]);

        $data = $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count = Banner::where('slug', $slug)->count();
        if($slug_count > 0) {
            $slug = time().'-'.$slug;
        }
        $data['slug'] = $slug;
        // return $data;


        $status = Banner::create($data);

        if($status) {
            return redirect('/admin/banners')->with('success', 'Banner has been created successfully.');
        }else {
            return back()->with('error', 'Something went wrong!');
        }
    }

    public function editBanner($id) 
    {
        $banner = Banner::find($id);
        
        if($banner) {
            return view('backEnd.banners.editBannerForm', compact('banner'));
        }else {
            return back()->with('error', 'Data not found');
        }
    }

    public function updateBanner(Request $request, $id) 
    {
        $banner = Banner::find($id);
        
        if($banner) {
            $request->validate([
                'title' => 'required',
                'description' => 'required|nullable',
                'photo' => 'required',
                'condition' => 'nullable|in:banner,promotional',
                'status' => 'nullable|in:active,inactive',
            ]);
    
            $data = $request->all();
            $status = $banner->fill($data)->save();
    
            if($status) {
                return redirect('/admin/banners')->with('success', 'Banner has been updated successfully.');
            }else {
                return back()->with('error', 'Something went wrong!');
            }
        }else {
            return back()->with('error', 'Data not found');
        }
       
    }

    public function deleteBanner($id) {
        $banner = Banner::find($id);

        if($banner) {
            $status = $banner->delete();
            if($status) {
                return redirect('/admin/banners')->with('success', 'Banner has been deleted successfully.');
            } else {
                return back()->with('error', 'Something went wrong!');
            }
        }
    }


    public function bannerChangeStatus(Request $request) 
    {
        // dd($request->all());
        if($request->mode == 'true') {
            $id = $request->id;
            DB::table('banners')->where('id', $id)->update(['status' => 'active']);
        }else {
            $id = $request->id;
            DB::table('banners')->where('id', $id)->update(['status' => 'inactive']);
        }
        return response()->json(['message' => 'Status has been updated successfully.', 'status' => true]);
    }
}
