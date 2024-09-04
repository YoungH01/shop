<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index(){
        return view('login.login');
    }
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ],[
            'email.required' => 'email không được bỏ trống',
            'email.email' => 'email không hợp lệ',
            'password.required' => 'mật khẩu không được bỏ trống',
            'password.min' => 'mật khẩu phải có ít nhất 6 ký tự'
        ]);
        $credentials =$request->only('email','password');
        if(Auth::attempt($credentials)){
            if(Auth::user()->role == 'admin'){
                return redirect()->route('dashboard.layout');
            }else return redirect()->route('login.layout')->withErrors(['message' => 'Bạn không có quyền truy cập vào trang này']);
        }else{
            return redirect()->back()->withErrors(['message' => 'email hoặc mật khẩu không đúng'])->withInput();
        }
    }
}
