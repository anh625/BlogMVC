<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'title' => 'required|max:255',
            'description' => 'required',
            'content' => 'required',
            'category_id' => 'required',
        ];

        if ($this->isMethod('post')) {
            // Khi tạo mới, bắt buộc có ảnh dạng base64
            $rules['thumbnail'] = [
                'required',
                'regex:/^data:image\/(jpeg|png|jpg|gif|svg\+xml);base64,/',
            ];
        } else {
            // Khi cập nhật, không bắt buộc có ảnh
            $rules['image'] = [
                'nullable',
                'regex:/^data:image\/(jpeg|png|jpg|gif|svg\+xml);base64,/',
            ];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Title is required',
            'description.required' => 'Description is required',
            'content.required' => 'Content is required',
            'thumbnail.required' => 'Ảnh là bắt buộc.',
            'thumbnail.regex' => 'Định dạng ảnh không hợp lệ. Vui lòng tải lên ảnh hợp lệ (jpeg, png, jpg, gif, svg).',
        ];
    }
}
