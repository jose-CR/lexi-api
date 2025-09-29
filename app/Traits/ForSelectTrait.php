<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

Trait ForSelectTrait
{
    /**
     * Devuelve un array listo para <select>.
     *
     * @param string $keyColumn     Columna que será el value del <option>
     * @param string $valueColumn   Columna que será el label del <option>
     * @param string|null $orderColumn Columna para ordenar (default: $keyColumn)
     * @param string|null $transformFunc Función SQL opcional (ej: 'LOWER', 'UPPER')
     * @return array
    */
    public static function ForSelect(string $keyColumn = 'id', string $valueColumn = 'name', ?string $orderColumn = null, ?string $transformFunc = null) : array
    {
        $query = static::select($keyColumn, $valueColumn);

        if($transformFunc)
        {
            $alias = "normalized_" . $valueColumn;
            $query->addSelect(DB::raw("$transformFunc($valueColumn) as $alias"));
            $orderColumn = $alias;
        }

        $query->orderBy($orderColumn ?? $keyColumn, 'asc');

        $result = $query->pluck($valueColumn, $keyColumn);

        return $result instanceof Collection ? $result->toArray() : (array)$result;
    }

}
