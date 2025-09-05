<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;


/**
 * @OA\Schema(
 *     schema="UpdateSubCategoryRequest",
 *     title="Update SubCategory Request",
 *     description="Datos para actualizar una subcategoría",
 *     @OA\Property(
 *         property="categoryId",
 *         type="integer",
 *         nullable=true,
 *         example=3,
 *         description="ID de la categoría padre (opcional)"
 *     ),
 *     @OA\Property(
 *         property="subCategory",
 *         type="string",
 *         example="Animales Domésticos",
 *         description="Nombre actualizado de la subcategoría"
 *     )
 * )
 */
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
