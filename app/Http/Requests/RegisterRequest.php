<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Only allow Admins
        return auth()->check() && auth()->user()->role?->name === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     * 
     * regex pattern to match at least include number and one special character
     */
    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|digits_between:10,15|unique:users', // dont add |numeric|, it will add decimal
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/[0-9]/',
                'regex:/[!@#$%^&*(),.?":{}|<>]/',
            ],
            'role_id' => 'required|integer|exists:roles,id', // Ensure role exists
            'division_id' => 'required|integer|exists:divisions,id', // Ensure division exists
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required' => 'Full name is required.',
            'full_name.string' => 'Full name must be a string.',
            'full_name.max' => 'Full name must not be greater than 255 characters.',
            'email.required' => 'Email is required.',
            'email.string' => 'Email must be a string.',
            'email.email' => 'Email must be a valid email address.',
            'email.max' => 'Email must not be greater than 255 characters.',
            'email.unique' => 'Email is already taken, please use another email.',
            'phone_number.required' => 'Phone number is required.',
            'phone_number.digits_between' => 'Phone number must be between 10 and 15 digits.',
            'phone_number.unique' => 'Phone number is already taken, please use another phone number.',
            'password.required' => 'Password is required.',
            'password.string' => 'Password must be a string.',
            'password.confirmed' => 'Password confirmation does not match.',
            'password.min' => 'Password must be at least 8 characters long.',
            'password.regex' => 'Password must contain at least one number and one special character.',
            'role_id.required' => 'Role is required.',
            'role_id.integer' => 'Role must be an integer.',
            'role_id.exists' => 'Role does not exist.',
            'division_id.required' => 'Division is required.',
            'division_id.integer' => 'Division must be an integer.',
            'division_id.exists' => 'Division does not exist.',
        ];
    }
}
