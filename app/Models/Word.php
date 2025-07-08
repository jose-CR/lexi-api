<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Word extends Model
{
    use HasFactory;

    protected $fillable = ['sub_category_id', 'letter', 'word', 'definition', 'spanish_sentence', 'sentence'];

    protected $casts = ['definition' => 'array'];

    public function subcategory(): BelongsTo{
        return $this->belongsTo(SubCategory::class);
    }
}
