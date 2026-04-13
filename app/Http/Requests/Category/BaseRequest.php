<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
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
            'title' => 'required|string|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Поле :attribute не должно быть пустым',
            'string' => 'Это поле должно быть строкой',
            'max' => 'Максимально допустимая длина это поля :max символов'
        ];
    }

    public function attributes(): array
    {
        return [
          'title' => 'Заголовок'
        ];
    }
}
