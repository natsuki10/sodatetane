<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required|max:255',
            'material' => 'required|max:255',
            'target_age' => 'required',
            'post_text' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'title' => '255字以内で入力してください。',
            'material' => '255字以内で入力してください。',
            'target_age' => '1つ以上選んでください。',
            'post_text' => '必ず入力してください',
        ];
    }
}
