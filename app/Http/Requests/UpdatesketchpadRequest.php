<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSketchpadRequest extends FormRequest
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
            'FIO' => [
                'max:200',
                'string',
                'required',
                'unique:sketchpads,fio',
                // 'regex:/^[\pL\s]+$/u',
            ],
            'company' => [
                'max:50',
                'string',
                'nullable',
            ],
            'telephone' => [
                'max:20',
                'string',
                'required',
                // 'regex:/^\+7\s\(\d{3}\)\s\d{3}-\d{2}-\d{2}$/',
            ],
            'email' => [
                'max:100',
                'string',
                'required',
                'unique:sketchpads,email',
                'email',
            ],
            'date_of_birth' => [
                'date',
                'after_or_equal:1930-11-11',
                'before:today',
            ],
            'photo' => [
                'max:100',
                'string',
                'nullable',
                // 'regex:/^[a-zA-Z0-9]{8}\.jpg$/', // Проверка на формат из 8 символов + .jpg (под вопросом эта строчка)
            ],
        ];
    }
}
