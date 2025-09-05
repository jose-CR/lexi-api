<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @OA\Schema(
 *     schema="SubCategory",
 *     title="SubCategory",
 *     description="Modelo de SubCategory",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="category_id", type="integer", example=2),
 *     @OA\Property(property="subcategory", type="string", example="Animales"),
 *     @OA\Property(
 *         property="category",
 *         ref="#/components/schemas/Category",
 *         nullable=true
 *     ),
 *     @OA\Property(
 *         property="words",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Word"),
 *         description="Lista de palabras relacionadas"
 *     ),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-05T12:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-09-05T12:00:00Z")
 * )
 */
class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'subcategory'];

    public function category(): BelongsTo{
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function words(): HasMany{
        return $this->hasMany(Word::class);
    }
}
