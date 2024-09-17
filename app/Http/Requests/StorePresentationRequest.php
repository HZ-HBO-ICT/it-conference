<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePresentationRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required',
            'type' => 'required',
            'difficulty_id' => 'required|numeric',
            'max_participants' => 'required|numeric',
            'user_id' => 'required|numeric'
        ];
    }

    /**
     * Add custom validation messages for the request
     * @return string[]
     */
    public function messages()
    {
        return [
            'user_id' => 'A user must be selected.',
        ];
    }
}
