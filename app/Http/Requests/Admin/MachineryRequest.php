<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class MachineryRequest extends FormRequest
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
            'model' => ['required', 'string', 'max:100'],
            'category' => ['required', 'string', 'in:Construction Machinery,Heavy Equipment,Agricultural Machinery'],
            'year' => ['required', 'integer', 'min:1990', 'max:2030'],
            'price' => ['required', 'integer', 'min:0'],
            'hours' => ['required', 'integer', 'min:0'],
            'fuel' => ['required', 'string', 'in:Diesel,Gasoline,Electric,Hybrid'],
            'capacity' => ['nullable', 'string', 'max:50'],
            'location' => ['required', 'string', 'in:Incheon Head Yard,Incheon Yard II,Pyeongtaek Port Yard,Busan Export Yard,Dubai Showroom'],
            'item_no' => ['nullable', 'string', 'max:50'],
            'serial_no' => ['nullable', 'string', 'max:50'],
            'engine' => ['nullable', 'string', 'max:50'],
            'status' => ['required', 'string', 'in:Available,Reserved,Sold'],
            'images' => [
                $this->isMethod('post') ? 'required' : 'nullable',
                'array',
                'max:15',
            ],
            'images.*' => ['image', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'images.required' => 'Please upload at least one photo.',
            'images.max' => 'You can upload a maximum of 15 photos.',
        ];
    }
}
