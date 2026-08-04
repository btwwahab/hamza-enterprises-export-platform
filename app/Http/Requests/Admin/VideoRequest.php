<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'video_url' => ['nullable', 'url', 'max:500'],
            'duration' => ['nullable', 'string', 'max:10'],
            'views' => ['nullable', 'integer', 'min:0'],
            'published_at' => ['required', 'date'],
            'thumbnail' => [$this->isMethod('post') ? 'required' : 'nullable', 'image', 'max:5120'],
        ];
    }
}
