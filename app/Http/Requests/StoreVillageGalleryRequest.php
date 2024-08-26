<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVillageGalleryRequest extends FormRequest
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
            'type_gallery_id' => 'required',
            'name' => 'required',
            'desc' => 'required',
            'image' => 'required',
            'is_show' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute harus diisi',
        ];
    }
}
