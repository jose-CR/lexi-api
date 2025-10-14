<?php

namespace App\Models;

use App\Traits\ForSelectTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    use ForSelectTrait;

    protected $fillable = ['category'];

    public function subcategories(): HasMany{
        return $this->hasMany(SubCategory::class);
    }
}
