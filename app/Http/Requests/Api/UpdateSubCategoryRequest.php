<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubCategoryRequest extends FormRequest
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
            'categoryId' => ['nullable', 'exists:categories,id'],
            'subCategory' => ['required', 'string', 'min:1', 'max:255']
        ];
    }

    protected function prepareForValidation()
    {
        $data = [];

        if($this->has('categoryId')){
            $data['category_id'] = $this->categoryId;
        }

        if($this->has('subCategory')){
            $data['subcategory'] = $this->subCategory;
        }

        $this->merge($data);
    }

}
