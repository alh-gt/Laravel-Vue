<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;

class StoreComputerLanguage extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('computer_languages')->ignore($this->id)
            ],
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '言語名が未入力です',
            'name.unique' => 'この言語名はすでに登録済みです',
            'description.required' => '説明が未入力です'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $exception = new ValidationException($validator);

        $errors = $exception->errors();
        throw new HttpResponseException(response()->json([
            'message' => 'Faild validation',
            'errors' => $errors,
        ], 422, [], JSON_UNESCAPED_UNICODE));
    }
}
