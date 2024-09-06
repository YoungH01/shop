<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        return [
            //
            'name_product' => 'required',
            'category' => 'required',
            'new_price' => 'required',
            'old_price' => 'required',
            'descriptions' => 'required',
            'quantity' => 'required',
            'images.*' => 'required|image|mimes:png,jpg,jpeg,webp'
        ];
    }
    public function messages()
    {
        return [
            'name_product.required' => 'Không được bỏ trống',
            'category.required' => 'Không được bỏ trống',
            'new_price.required' => 'Không được bỏ trống',
            'old_price.required' => 'Không được bỏ trống',
            'descriptions.required' => 'Không được bỏ trống',
            'quantity.required' => 'Không được bỏ trống',
            'images.*.required' => 'Vui lòng chọn ít nhất một hình ảnh.',
            'images.*.image' => 'Tất cả các file phải là hình ảnh.',
            'images.*.mimes' => 'Chỉ chấp nhận các định dạng: png, jpg, jpeg, webp.',
        ];
    }
}
