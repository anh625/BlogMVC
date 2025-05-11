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

        $base64Rule = 'regex:/^data:image\/(jpeg|png|jpg|gif|svg\+xml);base64,/';
        $imageRequirement = $this->isMethod('post') ? 'required' : 'nullable';

        $rules['thumbnail'] = [$imageRequirement, $base64Rule];
        $rules['banner_image'] = [$imageRequirement, $base64Rule];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Title is required',
            'description.required' => 'Description is required',
            'content.required' => 'Content is required',
            'thumbnail.required' => 'The thumbnail image is required.',
            'thumbnail.regex' => 'Invalid thumbnail image format. Please upload a valid image (JPEG, PNG, JPG, GIF, or SVG).',
            'banner_image.required' => 'The banner image is required.',
            'banner_image.regex' => 'Invalid banner image format. Please upload a valid image (JPEG, PNG, JPG, GIF, or SVG).',
        ];
    }
}
