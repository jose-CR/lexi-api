<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class SubCategoryFilter extends ApiFilter{
    protected $safeParams = [
        'id' => ['eq', 'lte', 'lt'],
        'categoryId' => ['eq', 'lte', 'lt'],
        'subCategory' => ['eq']
    ];


    protected $columnMap = [
        'categoryId' => 'category_id',
        'subCategory' => 'subcategory'
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
        'ne' => '!='
    ];
}