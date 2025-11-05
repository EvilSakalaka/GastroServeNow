<?php

namespace App\Http\Requests\manager;

use Illuminate\Foundation\Http\FormRequest;

class WorkerEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
            'username' => 'required|string|max:50',
            'email' => 'required|email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:manager,waiter,chef,bartender',
            'status' => 'required|in:active,inactive',
        ];
    }
}
