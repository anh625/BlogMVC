<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            //
            'name' => 'required|string',
            'phone_number' => 'required|string',
        ];
        $rules['avatar'] = [
            'nullable',
            'regex:/^data:image\/(jpeg|png|jpg|gif|svg\+xml);base64,/',
        ];
        if($this->method() == 'POST') {
            $rules['email'] = 'required|email|unique:users,email';
            $rules['password'] = 'required|string|confirmed';
        }
        return $rules;
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',

            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',

            'name.required' => 'Vui lòng nhập tên.',

            'phone_number.required' => 'Vui lòng nhập số điện thoại.',
            'avatar.regex' => 'Định dạng ảnh không hợp lệ. Vui lòng tải lên ảnh hợp lệ (jpeg, png, jpg, gif, svg).',
        ];
    }
}
