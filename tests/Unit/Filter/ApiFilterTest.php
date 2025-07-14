<?php

namespace Tests\Unit\Filter;

use PHPUnit\Framework\TestCase;
use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class ApiFilterTest extends TestCase
{
    protected $filter;

    protected function setUp(): void{
        parent::setUp();

        // Creamos una clase hija para poder setear propiedades protegidas
        $this->filter = new class extends ApiFilter {
            protected $safeParams = [
                'name' => ['eq', 'like'],
                'age' => ['gt', 'lt']
            ];
            protected $columnMap = [
                'name' => 'full_name',
                'age' => 'user_age'
            ];
            protected $operatorMap = [
                'eq' => '=',
                'like' => 'LIKE',
                'gt' => '>',
                'lt' => '<'
            ];
        };
    }

    public function test_transform_builds_correct_eloquent_query(){
        $queryParams = [
            'name' => [
                'eq' => 'John',
                'like' => '%Jo%'
            ],
            'age' => [
                'gt' => 18,
            ],
        ];
        
        $request = new Request($queryParams);

        $result = $this->filter->transform($request);

        $expected = [
            ['full_name', '=', 'John'],
            ['full_name', 'LIKE', '%Jo%'],
            ['user_age', '>', 18],
        ];

        $this->assertEquals($expected, $result);
    }

    public function test_transform_ignores_unsupported_params(){
        $queryParams = [
            'invalidParam' => ['eq' => 'test'],
            'name' => ['eq' => 'Alice'],
        ];

        $request = new Request(($queryParams));

        $result = $this->filter->transform($request);

        $expected = [
            ['full_name', '=', 'Alice'],
        ];

        $this->assertEquals($expected, $result);
    }

    public function test_transform_ignores_unsupported_operators(){
        $queryParams = [
            'name' => ['neq' => 'Bob'], // 'neq' no está en safeParams['name']
        ];

        $request = new Request($queryParams);

        $result = $this->filter->transform($request);

        $this->assertEmpty($result);
    }

}
