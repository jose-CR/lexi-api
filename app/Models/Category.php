<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    /**
     * @OA\Schema(
     *     schema="Category",
     *     type="object",
     *     title="Category",
     *     required={"id","name"},
     *     @OA\Property(property="id", type="integer", example=1),
     *     @OA\Property(property="name", type="string", example="Ejemplo"),
     *     @OA\Property(property="subcategories", type="array",
     *         @OA\Items(ref="#/components/schemas/Category")
     *     )
     * )
     */
    use HasFactory;

    protected $fillable = ['category'];

    public function subcategories(): HasMany{
        return $this->hasMany(SubCategory::class);
    }
}
