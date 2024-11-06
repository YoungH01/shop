<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * index function use for render list customer.
     * 
    */
    public function index()
    {
        $customers = User::where('role','customer')->get();

        return view('customer.display',compact('customers'));
    }

    /**
     * addView function use for render Add customer form layout.
    */
    public function addView()
    {
        return view('customer.add');
    }

    /**
     * addImplement function use for add customer.
     * 
    */
    public function addImplement(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'email' => 'required|email',
            'address' =>'required',
        ],[
            'name.required' => 'Vui lòng không bỏ trống',
            'password.required' => 'Vui lòng không bỏ trống',
            'password.confirmed' => 'Mật khẩu không khớp nhau',
            'password_confirmation.required' => 'Vui lòng không bỏ trống',
            'phone.required' => 'Vui lòng không bỏ trống',
            'phone.regex' => 'Số điện thoại không hợp lệ',
            'phone.min' => 'Số điện thoại phải có ít nhất 10 chữ số',
            'email.required' => 'Vui lòng không bỏ trống',
            'email.email' => 'Vui lòng nhập đúng định dạng email',
            'address.required' => 'Vui lòng không bỏ trống',
        ]);
        $customerData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => 'customer',
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ];
        User::create($customerData);
        return redirect()->route('customer.view');
    }

    /**
     * remove function use for remove customer.
     * @param id is id of customer
    */
    public function remove($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('customer.view');
    }

    /**
     * updateView function use for render Update customer form layout.
     * @param id is id of customer
    */
    public function updateView($id)
    {
        $customer = User::findOrFail($id);
        return view('customer.update',compact('customer'));
    }

    /**
     * updateImplement function use for update customer.
     * @param id is id of customer
    */
    public function updateImplement(Request $request, $id)
    {
        $customer = User::findOrFail($id);
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
        $customerData = [
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
        ];
        if ($request->filled('password')) {
            $customerData['password'] = Hash::make($request->password);
        }
        $customer->update($customerData);
        return redirect()->route('customer.view');
    }

    /**
     * detail function use for render history order of customer.
     * @param id is of customer
    */
    public function detail($id){
        $orders = Order::where('user_id',$id)->get();
        return view('customer.detail',compact('orders'));
    }
}
