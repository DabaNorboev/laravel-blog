<?php

namespace App\Http\Requests\Notification;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
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
            'filter' => 'nullable|in:all,unread,read|string|max:255',
        ];
    }
    public function messages(): array
    {
        return [
            'filter.in' => 'Фильтр может содержать один из следующих параметров: "Все", "Непрочитанные", "Прочитанные".',
        ];
    }
}
