<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('PUT')) {
            return [
                'subCategoryId' => ['nullable', 'exists:sub_categories,id'],
                'letter' => ['required', 'string', 'min:1', 'max:255'],
                'word' => ['required', 'string', 'min:1', 'max:255'],
                'definition' => ['required', 'array', 'min:1'],
                'sentence' => ['required', 'string', 'min:1', 'max:255'],
                'spanishSentence' => ['required', 'string', 'min:1', 'max:255'],
            ];
        }

        // PATCH: solo se validan los campos enviados
        return [
            'subCategoryId' => ['sometimes', 'nullable', 'exists:sub_categories,id'],
            'letter' => ['sometimes', 'string', 'min:1', 'max:255'],
            'word' => ['sometimes', 'string', 'min:1', 'max:255'],
            'definition' => ['sometimes', 'array', 'min:1'],
            'sentence' => ['sometimes', 'string', 'min:1', 'max:255'],
            'spanishSentence' => ['sometimes', 'string', 'min:1', 'max:255'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $mergeData = [];

        if ($this->has('subCategoryId')) {
            $mergeData['sub_category_id'] = $this->input('subCategoryId');
        }

        if ($this->has('spanishSentence')) {
            $mergeData['spanish_sentence'] = $this->input('spanishSentence');
        }

        if (is_array($this->definition)) {
            $mergeData['definition'] = json_encode($this->definition);
        }

        if (!empty($mergeData)) {
            $this->merge($mergeData);
        }
    }
}