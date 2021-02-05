<?php

namespace App\Http\Requests;
use App\User;
use Illuminate\Foundation\Http\FormRequest;

class TaiKhoan extends FormRequest
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
            
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:8',
            'fullname' => 'required|min:3',
            'phone' => 'required|size:10',
            'address' => 'required:min:50',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'email không được trống ',
            'email.email' => 'sai định dạng email, định dạng đúng example@gmail.com',
            'email.unique' => 'email đã tồn tại',
            'password.required' => 'Password không được trống',
            'password.min' => 'Password quá ngắn phải có ít nhất 6 kí tự',
            'password.max' => 'password quá dài phải ít hơn 8 kí tự',
            'fullname.required' => 'Tên không được trống',
            'fullname.min' => 'Tên quá ngắn phải có ít nhất 3 kí tự',
            'phone.required' => 'Số điện thoại không được trống',
            'phone.size' => 'Sai định dạng số điện thoại, số điện thoại có 10 chữ số',
            'address.required' => 'Địa chỉ không được trống',
            'address.min'   => 'Địa chỉ quá ngắn phải có ít nhất 50 kí tự'
        ];
    }
}
