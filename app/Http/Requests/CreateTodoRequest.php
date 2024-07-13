<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTodoRequest extends FormRequest
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
            'title'  => 'required|string|max:250',
            'task.*' => 'required|max:250',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'  => 'The title field is required.',
            'task.*.required' => 'The task field is required.',
        ];
    }

    public function attributes()
    {
        return [
            'task.*' => 'task',
        ];
    }
}
