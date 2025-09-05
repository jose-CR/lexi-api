<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;


/**
     * @OA\Schema(
     *     schema="BulkWordRequest",
     *     title="Bulk Word Request",
     *     description="Lista de palabras a crear en una sola petición",
     *     type="array",
     *     @OA\Items(
     *         type="object",
     *         required={"letter", "word", "definition", "sentence", "spanishSentence"},
     *         @OA\Property(
     *             property="subCategoryId",
     *             type="integer",
     *             nullable=true,
     *             example=3,
     *             description="ID de la subcategoría asociada (opcional)"
     *         ),
     *         @OA\Property(
     *             property="letter",
     *             type="string",
     *             example="C",
     *             description="Letra inicial de la palabra"
     *         ),
     *         @OA\Property(
     *             property="word",
     *             type="string",
     *             example="Casa",
     *             description="Palabra registrada"
     *         ),
     *         @OA\Property(
     *             property="definition",
     *             type="array",
     *             @OA\Items(type="string"),
     *             example={"Lugar para habitar", "Edificación destinada a vivienda"},
     *             description="Definición de la palabra (array de definiciones)"
     *         ),
     *         @OA\Property(
     *             property="sentence",
     *             type="string",
     *             example="The house is big.",
     *             description="Oración en otro idioma con la palabra"
     *         ),
     *         @OA\Property(
     *             property="spanishSentence",
     *             type="string",
     *             example="La casa es grande.",
     *             description="Oración en español con la palabra"
     *         )
     *     )
     * )
     */
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
            '*.definition' => ['required', 'array', 'min:1'],
            '*.sentence' => ['required', 'string', 'min:1', 'max:255'],
            '*.spanishSentence' => ['required', 'string', 'min:1', 'max:255'],
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
