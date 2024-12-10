<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstructorRegRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'bio' => ['nullable', 'string', 'max:255'],
            'nationality' => ['nullable', 'string'],
            'experience_years' => ['required', 'integer'],
            'experience_card' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'age' => ['nullable', 'integer', 'min:10', 'max:100'],
            'avatar' => ['required', 'image'],
            'ssn' => ['required', 'integer', 'digits:14'],
            'agree' => ['required'],
        ];
    }
}
