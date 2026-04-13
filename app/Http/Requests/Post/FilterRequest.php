<?php

namespace App\Http\Requests\Post;

class FilterRequest extends BaseRequest
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
            'search' => 'nullable|max:255|string',
            'category_id' => 'nullable|integer|exists:categories,id',
            'sort' => 'nullable|in:newest,oldest,popular|max:255|string',
            'tags.*' => 'integer|exists:tags,id',
        ];
    }

    public function attributes(): array
    {
        return [
            'search' => 'Поисковой запрос',
            'category_id' => 'Категория',
            'sort' => 'Сортировка',
            'tags.*' => 'Тег'
        ];
    }

    public function messages(): array
    {
        return [
            'max' => 'Поле :attribute не должно превышать :max символов',
            'exists' => 'Выбранный :attribute не существует',

            'string' => 'Поле :attribute должно быть строкой',
            'integer' => 'Поле :attribute должно быть числом',
            'date' => 'Поле :attribute должно быть датой в указанном формате',
            'sort.in' => 'Сортировка может быть выполнена только по предложенным критериям',
        ];
    }
}
