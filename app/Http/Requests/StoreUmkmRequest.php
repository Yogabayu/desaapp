<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUmkmRequest extends FormRequest
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
            'slug' => 'required',
            'name' => 'required',
            'desc' => 'required',
            'tlp' => 'required',
            'fb' => 'nullable',
            'ig' => 'nullable',
            'ytb' => 'nullable',
            'is_active' => 'required',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute harus diisi',
            'images.required' => 'Setidaknya satu gambar harus diunggah',
            'images.*.image' => 'File harus berupa gambar',
            'images.*.mimes' => 'Format gambar yang diizinkan: jpeg, png, jpg, gif, svg',
            'images.*.max' => 'Ukuran gambar maksimal 2MB',
        ];
    }
}
