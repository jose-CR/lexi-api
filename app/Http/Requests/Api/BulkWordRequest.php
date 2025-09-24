<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class BulkWordRequest extends FormRequest
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
            '*.subCategoryId' => ['nullable', 'exists:sub_categories,id'],
            '*.letter' => ['required', 'string', 'min:1', 'max:255'],
            '*.word' => ['required', 'string', 'min:1', 'max:255'],
            '*.definition' => ['required', 'string', 'min:1'],
            '*.sentence' => ['required', 'string', 'min:1', 'max:255'],
            '*.spanishSentence' => ['required', 'string', 'min:1', 'max:255'],
            '*.times' => ['nullable', 'array'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $prepared = [];

        foreach ($this->all() as $index => $item) {
            $item['sub_category_id'] = $item['subCategoryId'] ?? null;
            $item['spanish_sentence'] = $item['spanishSentence'] ?? null;
            $prepared[$index] = $item;
        }

        $this->replace($prepared);
    }
}
