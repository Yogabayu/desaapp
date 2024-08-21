<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
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
            'village_id' => 'required',
            'user_id' => 'required',
            'title' => 'required',
            'slug' => 'required',
            'content' => 'required',
            'status' => 'required',
            'thumbnail' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute harus diisi',
        ];
    }
}
