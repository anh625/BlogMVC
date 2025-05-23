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
            'email.required' => 'Email required',
            'email.email' => 'Invalid email format',

            'password.required' => 'Password required',
            'password.confirmed' => 'Confirmation password does not match',

            'name.required' => 'Name required',

            'phone_number.required' => 'Phone number required',
            'avatar.regex' => 'Invalid banner image format. Please upload a valid image (JPEG, PNG, JPG, GIF, or SVG).',
        ];
    }
}
