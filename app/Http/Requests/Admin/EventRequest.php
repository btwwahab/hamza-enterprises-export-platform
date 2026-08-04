<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'in:Events,Company News,Port Logs,Deliveries'],
            'event_date' => ['required', 'date'],
            'author' => ['required', 'string', 'max:100'],
            'shares_count' => ['nullable', 'integer', 'min:0'],
            'summary' => ['required', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:5120'],
        ];
    }
}
