<?php

namespace App\Http\Controllers\backEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserManagementController extends Controller
{
     //Customer
     public function showCustomers()
     {
         $customers = User::orderBy('id', 'DESC')->where('role', '=', 'customer')->get();
         return view('backEnd.users.customer.viewCustomers', compact('customers'));
     }
 
     public function createCustomer()
     {
         return view('backEnd.users.customer.createCustomerForm');
     }
 
 
     public function insertCustomer(Request $request)
     {
        $request->validate([
            'full_name' => 'required|string|unique:Users',
            'email' => 'required|string|email|unique:Users',
            'username' => 'required|string|unique:Users',
            'password' => [
                 'required',
                 Password::min(8)
                     ->mixedCase()
                     ->letters()
                     ->numbers()
                     ->symbols()
                     ->uncompromised(),
             ],
            'phone' => 'required|nullable|numeric',
            'address' => 'required|nullable',
            'city' => 'required|nullable',
            'state' => 'required|nullable',
            'country' => 'required|nullable',
            'postcode' => 'required|nullable',
            'role' => 'required|nullable'
         ]);
 
         $customer = new User;
         $customer->full_name = $request->full_name;
         $customer->email = $request->email;
         $customer->username = $request->username;
         $customer->password= Hash::make($request->password);
         $customer->phone = $request->phone;
         $customer->address = $request->address;
         $customer->city = $request->city;
         $customer->state = $request->state;
         $customer->country = $request->country;
         $customer->postcode = $request->postcode;
         $customer->role = $request->role;
      
          $status = $customer->save();
  
         if($status) {
             return redirect('/admin/customerManagement')->with('success', 'Customer account has been created successfully.');
         }else {
             return back()->with('error', 'Something went wrong!');
         }
 
         
     }
 
     public function editCustomer($id) 
     {
         $customer = User::find($id);
       
         if($customer) {
             return view('backEnd.users.customer.editCustomerForm', compact('customer'));
         }else {
             return back()->with('error', 'Data not found');
         }
     }
 
     public function updateCustomer(Request $request, $id) 
     {
         $customer = User::find($id);
    
         if($customer) {
            $request->validate([
                'full_name' => 'required|string',
                'email' => 'required|string|email',
                'username' => 'required|string',
                'phone' => 'required|nullable|numeric',
                'address' => 'required|nullable',
                'state' => 'required|nullable',
                'country' => 'required|nullable',
                'postcode' => 'required|nullable',
                'address' => 'required|nullable',
                'role' => 'required|nullable'
            ]);

            $customer->full_name = $request->full_name;
            $customer->email = $request->email;
            $customer->username = $request->username;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->city = $request->city;
            $customer->state = $request->state;
            $customer->country = $request->country;
            $customer->postcode = $request->postcode;
            $customer->role = $request->role;
         
             $status =$customer->save();
     
             if($status) {
                 return redirect('/admin/customerManagement')->with('success', 'Customer account has been updated successfully.');
             }else {
                 return back()->with('error', 'Something went wrong!');
             }
         }else {
             return back()->with('error', 'Data not found');
         }
     }
 
     public function deleteCustomer($id) {
         $customer = User::find($id);
 
         if($customer) {
             $status = $customer->delete();
             if($status) {
                 return redirect('/admin/customerManagement')->with('success', 'Customer account has been deleted successfully.');
             } else {
                 return back()->with('error', 'Something went wrong!');
             }
         }
     }
 
     public function resetPasswordCustomer($id) {
         $customer = User::find($id);
       
         if($customer) {
             return view('backEnd.users.customer.resetPasswordCustomer', compact('customer'));
         }else {
             return back()->with('error', 'Data not found');
         }
     }
 
     public function updateNewPasswordCustomer(Request $request, $id) {
         $customer = User::find($id);
    
         if($customer) {
             $request->validate([
                 'password' => [
                     'required',
                     Password::min(8)
                         ->mixedCase()
                         ->letters()
                         ->numbers()
                         ->symbols()
                         ->uncompromised(),
                 ],
             ]);
 
             $customer->password= Hash::make($request->password);
             $status = $customer->save();
     
             if($status) {
                 return redirect('/admin/customerManagement')->with('success', 'Password has been reset successfully.');
             }else {
                 return back()->with('error', 'Something went wrong!');
             }
         }else {
             return back()->with('error', 'Data not found');
         }
     }
 
 
     //Admin
     public function showAdmins()
     {
         $admins = User::orderBy('id', 'DESC')->where('role', '=', 'admin')->get();
         return view('backEnd.users.admin.viewAdmins', compact('admins'));
     }
     public function createAdmin()
     {
         return view('backEnd.users.admin.createAdminForm');
     }
 
 
     public function insertAdmin(Request $request)
     {
         $request->validate([
            'full_name' => 'required|string|unique:Users',
            'email' => 'required|string|email|unique:Users',
            'username' => 'required|string|unique:Users',
            'password' => [
                 'required',
                 Password::min(8)
                     ->mixedCase()
                     ->letters()
                     ->numbers()
                     ->symbols()
                     ->uncompromised(),
             ],
            'phone' => 'required|nullable|numeric',
            'address' => 'required|nullable',
            'city' => 'required|nullable',
            'state' => 'required|nullable',
            'country' => 'required|nullable',
            'postcode' => 'required|nullable',
            'role' => 'required|nullable'
         ]);
 
         $admin = new User;
         $admin->full_name = $request->full_name;
         $admin->email = $request->email;
         $admin->username = $request->username;
         $admin->password= Hash::make($request->password);
         $admin->phone = $request->phone;
         $admin->address = $request->address;
         $admin->city = $request->city;
         $admin->state = $request->state;
         $admin->country = $request->country;
         $admin->postcode = $request->postcode;
         $admin->role = $request->role;
     
         $status = $admin->save();
 
         if($status) {
             return redirect('admin/adminManagement')->with('success', 'Admin account has been created successfully.');
         }else {
             return back()->with('error', 'Something went wrong!');
         }
         
     }
 
     public function editAdmin($id) 
     {
         $admin = User::find($id);
       
         if($admin) {
             return view('backEnd.users.admin.editAdminForm', compact('admin'));
         }else {
             return back()->with('error', 'Data not found');
         }
     }
 
     public function updateAdmin(Request $request, $id) 
     {
         $admin = User::find($id);
    
         if($admin) {
             $request->validate([
                 'full_name' => 'required|string',
                 'email' => 'required|string|email',
                 'username' => 'required|string',
                 'phone' => 'required|nullable|numeric',
                 'address' => 'required|nullable',
                 'state' => 'required|nullable',
                 'country' => 'required|nullable',
                 'postcode' => 'required|nullable',
                 'address' => 'required|nullable',
                 'role' => 'required|nullable'
             ]);
 
             $admin->full_name = $request->full_name;
             $admin->email = $request->email;
             $admin->username = $request->username;
             $admin->phone = $request->phone;
             $admin->address = $request->address;
             $admin->city = $request->city;
             $admin->state = $request->state;
             $admin->country = $request->country;
             $admin->postcode = $request->postcode;
             $admin->role = $request->role;
         
             $status = $admin->save();
     
             if($status) {
                 return redirect('admin/adminManagement')->with('success', 'Admin account has been updated successfully.');
             }else {
                 return back()->with('error', 'Something went wrong!');
             }
         }else {
             return back()->with('error', 'Data not found');
         }
     }
 
     public function deleteAdmin($id) {
         $admin = User::find($id);
 
         if($admin) {
             $status = $admin->delete();
             if($status) {
                 return redirect('admin/adminManagement')->with('success', 'Admin account has been deleted successfully.');
             } else {
                 return back()->with('error', 'Something went wrong!');
             }
         }
     }
 
     public function resetPasswordAdmin($id) {
         $admin = User::find($id);
       
         if($admin) {
             return view('backEnd.users.admin.resetPasswordAdmin', compact('admin'));
         }else {
             return back()->with('error', 'Data not found');
         }
     }
 
     public function updateNewPasswordAdmin(Request $request, $id) {
       
         $admin = User::find($id);
    
         if($admin) {
             $request->validate([
                 'password' => [
                     'required',
                     Password::min(8)
                         ->mixedCase()
                         ->letters()
                         ->numbers()
                         ->symbols()
                         ->uncompromised(),
                 ],
             ]);
 
             $admin->password= Hash::make($request->password);
             $status = $admin->save();
     
             if($status) {
                 return redirect('admin/adminManagement')->with('success', 'Password been reset successfully.');
             }else {
                 return back()->with('error', 'Something went wrong!');
             }
         }else {
             return back()->with('error', 'Data not found');
         }
     }
}
