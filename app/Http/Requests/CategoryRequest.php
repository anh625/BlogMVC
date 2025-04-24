<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'category_name' => 'required|string|max:255',
            // 'category_slug' => 'nullable|string|max:255|unique:categories,category_slug,' . $this->category_id . ',category_id',
        ];
    }

    public function messages(): array
    {
        return [
            'category_name.required' => 'Tên danh mục là bắt buộc.',
            'category_name.max' => 'Tên danh mục không được vượt quá 255 ký tự.',
            // 'category_slug.max' => 'Slug không được vượt quá 255 ký tự.',
            // 'category_slug.unique' => 'Slug đã tồn tại trong hệ thống.',
        ];
    }

    // protected function failedValidation(Validator $validator)
    // {
    //     throw new HttpResponseException(response()->json([
    //         'status' => 400,
    //         'message' => 'Validation errors',
    //         'errors' => $validator->errors()
    //     ], 400));
    // }
}
