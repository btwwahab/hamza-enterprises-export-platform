<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'author' => ['required', 'string', 'max:100'],
            'location' => ['required', 'string', 'max:100'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'avatar_initial' => ['nullable', 'string', 'max:2'],
            'avatar_color' => ['nullable', 'string', 'max:20'],
            'text' => ['required', 'string', 'max:1000'],
        ];
    }
}
