<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
