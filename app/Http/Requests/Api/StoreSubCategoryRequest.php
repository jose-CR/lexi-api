<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="StoreSubCategoryRequest",
 *     title="Store SubCategory Request",
 *     description="Datos necesarios para crear una subcategoría",
 *     required={"subCategory"},
 *     @OA\Property(
 *         property="categoryId",
 *         type="integer",
 *         nullable=true,
 *         example=2,
 *         description="ID de la categoría padre (opcional)"
 *     ),
 *     @OA\Property(
 *         property="subCategory",
 *         type="string",
 *         example="Animales",
 *         description="Nombre de la subcategoría"
 *     )
 * )
 */
class StoreSubCategoryRequest extends FormRequest
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
        $this->merge([
            'category_id' => $this->categoryId,
            'subcategory' => $this->subCategory,
        ]);
    }
}
