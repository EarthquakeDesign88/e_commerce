<?php

namespace App\Http\Controllers\backEnd;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Setting;


class SettingsController extends Controller
{
    public function setWebsiteInfo()
    {
        $web_info = Setting::orderBy('id', 'DESC')->get();
        return view('backEnd.settings.viewSetWebsite', compact('web_info'));
    }

    public function updateWebsiteInfo(Request $request) 
    {
        $web_info = Setting::first();

        $status = $web_info->update([
            'title' => $request->title,
            'logo' => $request->logo,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'facebook_url' => $request->facebook_url,
            'instagram_url' => $request->instagram_url,
            'line_url' => $request->line_url,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'meta_image' => $request->meta_image,
            'meta_url' => $request->meta_url,
            'apple-touch-icon' => $request->apple_touch_icon,
            'icon_sm' => $request->icon_sm,
            'icon_md' => $request->icon_md,
        ]);
        
        
        if($status) {
            return redirect('/admin/setWebsiteInfo')->with('success', 'Website info has been updated successfully.');
        }else {
            return back()->with('error', 'Something went wrong!');
        }
    
       
    }

    public function setAboutUs()
    {
        $aboutUs = AboutUs::get();
        return view('backEnd.page_setup.viewSetAboutUs', compact('aboutUs'));
    }

    public function updateAboutUs(Request $request) 
    {
        $aboutUs = AboutUs::first();

        $status = $aboutUs->update([
            'header' => $request->header,
            'content' => $request->content,
            'more_details' => $request->more_details,
            'image' => $request->image,
        ]);
        
        
        if($status) {
            return redirect('/admin/setAboutUs')->with('success', 'About us has been updated successfully.');
        }else {
            return back()->with('error', 'Something went wrong!');
        }
       
    }

    public function setSMTP()
    {
        return view('backEnd.settings.viewSetSMTP');
    }

    public function updateSMTP(Request $request)
    {
        // dd($request->all());
        foreach($request->types as $key=>$type) {
            $this -> overWriteEnvFile($type, $request[$type]);
        }

        return back()->with('success', 'SMTP configuration updated successfully.');
    }

    public function overWriteEnvFile($type, $val)
    {
        $path = base_path('.env');
        
        if(file_exists($path)) {
            $val = '"'.trim($val).'"';
            if(is_numeric(strpos(file_get_contents($path),$type)) && strpos(file_get_contents($path), $type) >= 0) {
                file_put_contents($path, str_replace(
                    $type.'="'.env($type).'"', $type.'='.$val, file_get_contents($path)
                ));
            } else {
                file_put_contents($path, file_get_contents($path)."\r\n".$type. '='.$val);
            }
        }
    }

    public function setPaypal()
    {
        $setPaypal = Setting::select('paypal_sandbox')->orderBy('id', 'DESC')->get();
        return view('backEnd.settings.viewsetPaypal', compact('setPaypal'));
    }

    public function updatePaypal(Request $request)
    {
        // foreach($request->types as $pay=>$type) {
        //     $this -> overWriteEnvFile($type, $request[$type]);
        // }

        $settings = Setting::first();
        if($request->has('paypal_sandbox')) {
            $settings->paypal_sandbox = 1;
            $settings->save();
        } else {
            $settings->paypal_sandbox = 0;
            $settings->save();
        }

        return back()->with('success', 'Payment setting updated successfully.');
    }
  
    public function setOmise()
    {
        return view('backEnd.settings.viewsetOmise');
    }
}
