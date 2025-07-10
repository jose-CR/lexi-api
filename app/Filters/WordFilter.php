<?php 

namespace App\Filters;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class WordFilter extends ApiFilter{
    protected $safeParams = [
        'id' => ['eq'],
        'subCategoryId' => ['eq'],
        'letter' => ['eq', 'gte', 'lt', 'lte', 'gt'],
        'word' => ['eq', 'gte', 'lt', 'lte'],
        'definition' => ['eq']
    ];

    protected $columnMap = [
        'subCategoryId' => 'sub_category_id',
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>='
    ];
}