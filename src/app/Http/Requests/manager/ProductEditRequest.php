<?php

namespace App\Http\Requests\manager;

use Illuminate\Foundation\Http\FormRequest;

class ProductEditRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:available,unavailable',
            'photo_url' => 'nullable|url|max:255',
            'is_featured' => 'sometimes|boolean',
            'area_id' => 'required|exists:areas,area_id',
        ];
    }
}
