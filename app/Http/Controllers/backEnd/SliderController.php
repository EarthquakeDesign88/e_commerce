<?php

namespace App\Http\Controllers\backEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    public function showSliders()
    {
        $sliders = Slider::orderBy('id', 'DESC')->get();
        return view('backEnd.sliders.viewSliders', compact('sliders'));
    }

    public function createSlider()
    {
        return view('backEnd.sliders.createSliderForm');
    }

    public function insertSlider(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:sliders',
            'sub_title' => 'required|nullable',
            'description' => 'required|nullable',
            'photo' => 'required',
            'status' => 'nullable|in:active,inactive',
        ]);

        $data = $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count = Slider::where('slug', $slug)->count();
        if($slug_count > 0) {
            $slug = time().'-'.$slug;
        }
        $data['slug'] = $slug;
        // return $data;

        $status = Slider::create($data);

        if($status) {
            return redirect('/admin/sliders')->with('success', 'Slider has been created successfully.');
        }else {
            return back()->with('error', 'Something went wrong!');
        }
    }

    public function editSlider($id) 
    {
        $slider = Slider::find($id);
        
        if($slider) {
            return view('backEnd.sliders.editSliderForm', compact('slider'));
        }else {
            return back()->with('error', 'Data not found');
        }
    }

    public function updateSlider(Request $request, $id) 
    {
        $slider = Slider::find($id);
        
        if($slider) {
            $request->validate([
                'title' => 'required',
                'sub_title' => 'required|nullable',
                'description' => 'required|nullable',
                'photo' => 'required',
                'status' => 'nullable|in:active,inactive',
            ]
            );
    
            $data = $request->all();
            $status = $slider->fill($data)->save();
    
            if($status) {
                return redirect('/admin/sliders')->with('success', 'Slider has been updated successfully.');
            }else {
                return back()->with('error', 'Something went wrong!');
            }
        }else {
            return back()->with('error', 'Data not found');
        }
       
    }

    public function deleteSlider($id) {
        $slider = Slider::find($id);

        if($slider) {
            $status = $slider->delete();
            if($status) {
                return redirect('/admin/sliders')->with('success', 'Slider has been deleted successfully.');
            } else {
                return back()->with('error', 'Something went wrong!');
            }
        }
    }


    public function sliderChangeStatus(Request $request) 
    {
        // dd($request->all());
        if($request->mode == 'true') {
            $id = $request->id;
            DB::table('sliders')->where('id', $id)->update(['status' => 'active']);
        }else {
            $id = $request->id;
            DB::table('sliders')->where('id', $id)->update(['status' => 'inactive']);
        }
        return response()->json(['message' => 'Status has been updated successfully.', 'status' => true]);
    }
}
