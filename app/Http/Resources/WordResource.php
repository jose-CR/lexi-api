<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WordResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'subCategoryId' => $this->sub_category_id,
            'letter' => $this->letter,
            'word' => $this->word,
            'definition' => $this->definition,
            'sentence' => $this->sentence,
            'spanishSentence' => $this->spanish_sentence,
            'times' => $this->times,
        ];
    }
}
