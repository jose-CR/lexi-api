<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Log;

/**
 * @OA\Schema(
 *     schema="Word",
 *     title="Word",
 *     description="Modelo de palabras asociadas a una subcategoría",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="sub_category_id", type="integer", example=2),
 *     @OA\Property(property="letter", type="string", maxLength=1, example="A"),
 *     @OA\Property(property="word", type="string", example="Apple"),
 *     @OA\Property(
 *         property="definition",
 *         type="array",
 *         @OA\Items(type="string"),
 *         example={"A fruit", "A tech company"}
 *     ),
 *     @OA\Property(property="spanish_sentence", type="string", example="La manzana es una fruta."),
 *     @OA\Property(property="sentence", type="string", example="Apple is a leading tech company."),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-05T12:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-09-05T12:00:00Z")
 * )
*/
class Word extends Model
{
    use HasFactory;

    protected $fillable = ['sub_category_id', 'letter', 'word', 'definition', 'spanish_sentence', 'sentence'];

    protected $casts = ['definition' => 'array'];

    public function subcategory(): BelongsTo{
        return $this->belongsTo(SubCategory::class);
    }

    public function getStringDefinitionAttribute(): string{
        if (is_string($this->definition)) {
            $decodedValue = json_decode($this->definition, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decodedValue)) {
                return implode(', ', $decodedValue);
            } else {
                Log::error('No se pudo decodificar la definición JSON: ' . $this->definition);
            }
        }
        else
        {
            Log::warning('La definición ya es un array: ' . json_encode($this->definition));
        }
        return is_array($this->definition) ? implode(', ', $this->definition) : $this->definition;
    }
}
