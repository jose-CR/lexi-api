<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

/**
     * @OA\Schema(
     *     schema="StoreWordRequest",
     *     title="Store Word Request",
     *     description="Datos necesarios para crear una palabra",
     *     required={"subCategoryId", "letter", "word", "definition", "spanishSentence", "sentence"},
     *     @OA\Property(
     *         property="subCategoryId",
     *         type="integer",
     *         example=5,
     *         description="ID de la subcategoría asociada"
     *     ),
     *     @OA\Property(
     *         property="letter",
     *         type="string",
     *         example="A",
     *         description="Letra inicial de la palabra"
     *     ),
     *     @OA\Property(
     *         property="word",
     *         type="string",
     *         example="Árbol",
     *         description="Palabra registrada"
     *     ),
     *     @OA\Property(
     *         property="definition",
     *         type="string",
     *         example="Planta perenne con tallo leñoso que se ramifica a cierta altura del suelo.",
     *         description="Definición de la palabra"
     *     ),
     *     @OA\Property(
     *         property="spanishSentence",
     *         type="string",
     *         example="El árbol da sombra en verano.",
     *         description="Oración en español con la palabra"
     *     ),
     *     @OA\Property(
     *         property="sentence",
     *         type="string",
     *         example="The tree gives shade in summer.",
     *         description="Oración en otro idioma con la palabra"
     *     )
     * )
     */
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
            'sentence' => ['required', 'string', 'min:1', 'max:255']
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
