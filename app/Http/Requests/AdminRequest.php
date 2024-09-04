<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' =>'required',
            'email' =>'required|email',
            'address' =>'required',
        ];

        if ($this->filled('password')) {
            $rules['password'] = 'required|confirmed';
            $rules['password_confirmation'] = 'required';
        }

        return $rules;
    }
    public function messages()
    {
        return [
            'name.required' =>'Vui lòng nhập tên',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.confirmed' =>'Mật khẩu không khớp nhau',
            'password_confirmation.required' => 'Vui lòng xác nhận mật khẩu',
            'email.required' =>'Vui lòng nhập email',
            'email.email' =>'Vui lòng nhập đúng định dạng email',
            'address.required' =>'Vui lòng nhập địa chỉ',
        ];
    }
}
