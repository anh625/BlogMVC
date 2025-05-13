<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
        return [
            //
            'contact_name' => 'required|string',
            'contact_phone' => 'required|numeric',
            'subject' => 'required|string',
            'message' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'contact_name.required' => 'Name is required',
            'contact_name.string' => 'Name is invalid',
            'contact_phone.required' => 'Phone is required',
            'contact_phone.numeric' => 'Phone is invalid',
            'subject.required' => 'Subject is required',
            'subject.string' => 'Subject is invalid',
            'message.required' => 'Message is required',
            'message.string' => 'Message is invalid',
        ];
    }
}
