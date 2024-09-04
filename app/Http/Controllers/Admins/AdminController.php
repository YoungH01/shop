<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function index(){
        $admins = User::where('role','admin')->get();
        return view('admins.display',compact('admins'));
    }
    public function addView(){
        return view('admins.add');
    }
    public function addImplement(Request $request){
        $request->validate([
            'name' =>'required',
            'password' => 'required|confirmed',
            'password_confirmation' =>'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'email' =>'required|email',
            'address' =>'required',
        ],[
            'name.required' =>'Vui lòng không bỏ trống',
            'password.required' => 'Vui lòng không bỏ trống',
            'password.confirmed' =>'Mật khẩu không khớp nhau',
            'password_confirmation.required'=>'Vui lòng không bỏ trống',
            'phone.required' => 'Vui lòng không bỏ trống',
            'phone.regex' => 'Số điện thoại không hợp lệ',
            'phone.min' => 'Số điện thoại phải có ít nhất 10 chữ số',
            'email.required' =>'Vui lòng không bỏ trống',
            'email.email' =>'Vui lòng nhập đúng định dạng email',
            'address.required' =>'Vui lòng không bỏ trống',
        ]);
        $adminData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => 'admin',
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ];
        $admins = User::create($adminData);
        return redirect()->route('admins.view');
    }
    public function remove($id){
        $admin = User::findOrFail($id);
        $admin->delete();
        return redirect()->route('admins.view');
    }
    public function updateView($id){
        $admin = User::findOrFail($id);
        return view('admins.update',compact('admin'));
    }
    public function updateImplement(Request $request, $id){
        $admin = User::findOrFail($id);
        $request->validate([
            'name' =>'required',
            'password' => 'nullable|string|min:6',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'email' =>'required|email',
            'address' =>'required',
        ],[
            'name.required' =>'Vui lòng không bỏ trống', 
            'password.min' =>'Mật khẩu phải có ít nhất 6 ký tự',           
            'phone.required' => 'Vui lòng không bỏ trống',
            'phone.regex' => 'Số điện thoại không hợp lệ',
            'phone.min' => 'Số điện thoại phải có ít nhất 10 chữ số',
            'email.required' =>'Vui lòng không bỏ trống',
            'email.email' =>'Vui lòng nhập đúng định dạng email',
            'address.required' =>'Vui lòng không bỏ trống',
        ]);
        $adminData=[
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
        ];
        if($request->filled('password')){
            $adminData['password'] = Hash::make($request->password);
        }
        $admin->update($adminData);
        return redirect()->route('admins.view');
    }
}
