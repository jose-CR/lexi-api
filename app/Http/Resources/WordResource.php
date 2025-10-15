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
        $times = [];
        if (is_array($this->times)) {
            foreach ($this->times as $key => $value) {
                // Si el valor es un objeto (asociativo), lo envolvemos en un array
                $times[$key] = is_array($value) && array_keys($value) !== range(0, count($value) - 1)
                    ? [$value]
                    : $value;
            }
        }

        return [
            'id' => $this->id,
            'subCategoryId' => $this->sub_category_id,
            'letter' => $this->letter,
            'word' => $this->word,
            'definition' => $this->definition,
            'sentence' => $this->sentence,
            'spanishSentence' => $this->spanish_sentence,
            'times' => $times,
        ];
    }
}
