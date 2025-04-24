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
            // Khi tạo mới, bắt buộc có hình ảnh
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20480';
        } else {
            // Khi cập nhật, hình ảnh không bắt buộc
            $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Title is required',
            'description.required' => 'Description is required',
            'content.required' => 'Content is required',
            'image.required' => 'Image is required',
            'image.image' => 'Image is image',
            'image.mimes' => 'Image is mimes',
            'image.max' => 'Image is too large',
        ];
    }
}
