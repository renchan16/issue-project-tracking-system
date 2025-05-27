<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'nullable'
        ];
    }

    public function attributes()
    {
        return [
            'name' => "Full Name",
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Full Name field is required.',
            // 'password.min' => 'Password must be at least 8 characters long.',
            // 'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, and one number.',
        ];
    }
}
