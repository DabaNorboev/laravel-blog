<?php

namespace App\Http\Requests\Post;

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
            'title' => 'required|max:255|string',
            'category_id' => 'required|integer|exists:categories,id',
            'content' => 'required|string',
            'image' => 'required|max:255|string',
            'tags' => 'nullable|array|exists:tags,id',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'Заголовок',
            'category_id' => 'Категория',
            'content' => 'Текст',
            'image' => 'Изображение',
            'tags' => 'Теги'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Поле :attribute обязательно для заполнения',
            'max' => 'Поле :attribute не должно превышать :max символов',
            'exists' => 'Выбранный :attribute не существует',

            'string' => 'Поле :attribute должно быть строкой',
            'integer' => 'Поле :attribute должно быть числом',
            'array' => 'Поле :attribute должно быть массивом',

            'tags.*.exists' => 'Один или несколько тегов не существует',
            'category_id.required' => 'Необходимо выбрать категорию'
        ];
    }
}
