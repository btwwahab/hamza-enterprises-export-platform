<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PartRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'maker' => ['required', 'string', 'max:100'],
            'model' => ['nullable', 'string', 'max:100'],
            'category' => ['required', 'string', 'in:Engine,Transmission,Lighting,Body Parts,Suspension'],
            'images' => ['nullable', 'array', 'max:5'],
            'images.*' => ['image', 'max:4096'],
            'year' => ['nullable', 'integer', 'min:1990', 'max:2030'],
            'price' => ['required', 'integer', 'min:0'],
            'condition' => ['required', 'string', 'in:New,Used,Rebuilt'],
            'location' => ['nullable', 'string', 'max:100'],
            'part_no' => ['nullable', 'string', 'max:50'],
            'oem_no' => ['nullable', 'string', 'max:100'],
            'engine_type' => ['nullable', 'string', 'max:100'],
            'weight' => ['nullable', 'string', 'max:30'],
            'fits_models' => ['nullable', 'string', 'max:255'],
            'hp' => ['nullable', 'string', 'max:30'],
            'stock' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'string', 'in:Available,Reserved,Sold'],
        ];
    }

    public function messages(): array
    {
        return [
            'images.max' => 'You can upload a maximum of 5 photos.',
        ];
    }
}
