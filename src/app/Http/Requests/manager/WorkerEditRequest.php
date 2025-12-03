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
            'username' => 'required|string|max:50',
            'email' => 'email',
            'password' => 'nullable|string|min:8|max:255',
            'role' => 'required|in:manager,waiter,chef,bartender',
            'status' => 'required|in:active,inactive',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'A név megadása kötelező.',
            'name.max' => 'A név nem lehet hosszabb, mint 255 karakter.',
            'username.required' => 'A felhasználónév megadása kötelező.',
            'username.max' => 'A felhasználónév nem lehet hosszabb, mint 50 karakter.',
            'email.email' => 'Az email címnek érvényes formátumúnak kell lennie.',
            'password.min' => 'A jelszónak legalább 8 karakter hosszúnak kell lennie.',
            'password.max' => 'A jelszó nem lehet hosszabb, mint 255 karakter.',
            'role.required' => 'A szerepkör megadása kötelező.',
            'role.in' => 'A szerepkörnek manager, waiter, chef vagy bartender értékűnek kell lennie.',
            'status.required' => 'Az állapot megadása kötelező.',
            'status.in' => 'Az állapotnak active vagy inactive értékűnek kell lennie.',
        ];
    }
}
