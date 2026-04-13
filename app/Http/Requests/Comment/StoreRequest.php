<?php

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'comment' => ['required', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'comment' => 'Комментарий',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Поле :attribute должно быть заполнено',
            'string' => 'Поле :attribute должно быть строкой'
        ];
    }
}
