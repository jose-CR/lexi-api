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
                'sub_category_id' => ['nullable', 'exists:sub_categories,id'],
                'letter' => ['required', 'string', 'min:1', 'max:255'],
                'word' => ['required', 'string', 'min:1', 'max:255'],
                'definition' => ['required', 'array', 'min:1'],
                'sentence' => ['required', 'string', 'min:1', 'max:255'],
                'spanish_sentence' => ['required', 'string', 'min:1', 'max:255'],
            ];
        }
    
        return [
            'sub_category_id' => ['sometimes', 'nullable', 'exists:sub_categories,id'],
            'letter' => ['sometimes', 'string', 'min:1', 'max:255'],
            'word' => ['sometimes', 'string', 'min:1', 'max:255'],
            'definition' => ['sometimes', 'array', 'min:1'],
            'sentence' => ['sometimes', 'string', 'min:1', 'max:255'],
            'spanish_sentence' => ['sometimes', 'string', 'min:1', 'max:255'],
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
    
        if (!empty($mergeData)) {
            $this->merge($mergeData);
        }
    }
}