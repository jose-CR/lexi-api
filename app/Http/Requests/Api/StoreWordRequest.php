<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreWordRequest extends FormRequest
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
            'subCategoryId' => ['required', 'exists:sub_categories,id'],
            'letter' => ['required', 'string', 'min:1', 'max:255'],
            'word' => ['required', 'string', 'min:1', 'max:255'],
            'definition' => ['required', 'string', 'min:1'],
            'spanishSentence' => ['required', 'string', 'min:1', 'max:255'],
            'sentence' => ['required', 'string', 'min:1', 'max:255'],
            'times' => ['nullable', 'array']
        ];
    }

    protected function prepareForValidation(){
        if ($this->filled('definition') && is_array($this->definition)) {
            $this->merge([
                'definition' => json_encode($this->definition)
            ]);
        }

        if ($this->filled('subCategoryId')) {
            $this->merge([
                'sub_category_id' => $this->subCategoryId,
                'spanish_sentence' => $this->spanishSentence
            ]);
        }
    }
}
