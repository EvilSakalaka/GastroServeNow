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
            'photo_url' => ['nullable','url','max:255','regex:/\.(jpg|jpeg|png|gif|webp)$/i'],
            'is_featured' => 'sometimes|boolean',
            'area_id' => 'required|exists:areas,area_id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'A termék neve kötelező.',
            'name.max' => 'A termék neve nem lehet hosszabb, mint 255 karakter.',
            'category.required' => 'A kategória megadása kötelező.',
            'category.max' => 'A kategória nem lehet hosszabb, mint 255 karakter.',
            'price.required' => 'Az ár megadása kötelező.',
            'price.numeric' => 'Az árnak számnak kell lennie.',
            'price.min' => 'Az ár nem lehet kisebb, mint 0.',
            'status.required' => 'A státusz megadása kötelező.',
            'status.in' => 'A státusznak elérhető vagy nem elérhető értékűnek kell lennie.',
            'photo_url.url' => 'A fotó URL-nek érvényes URL-nek kell lennie.',
            'photo_url.max' => 'A fotó URL nem lehet hosszabb, mint 255 karakter.',
            'photo_url.regex' => 'A fotó URL-nek egy érvényes képformátumra kell végződnie (jpg, jpeg, png, gif, webp).',
            'area_id.required' => 'A terület megadása kötelező.',
            'area_id.exists' => 'A kiválasztott terület érvénytelen.',
        ];
    }
}
