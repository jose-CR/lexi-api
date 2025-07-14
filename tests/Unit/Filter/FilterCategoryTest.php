<?php

namespace Tests\Unit\Filter;

use App\Filters\CategoryFilter;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

class FilterCategoryTest extends TestCase
{

    /** @var CategoryFilter */
    protected $filter;

    protected function setUp(): void{
        parent::setUp();
        $this->filter = new CategoryFilter();
    }

    /** @test */
    public function transform_returns_empty_array_when_no_query_params(): void{
        $request = new Request();              // sin parámetros
        $result  = $this->filter->transform($request);
    
        $this->assertIsArray($result);
        $this->assertEmpty($result);
    }
    
    /** @test */
    public function transform_maps_id_and_category_correctly(): void{
        $request = new Request([
            'id' => ['eq' => 5],
            'category' => [
                'eq'  => 'Inglés',
                'lt'  => 'M',
                'lte' => 'Z',
            ],
        ]);

        $result = $this->filter->transform($request);

        $expected = [
            ['id', '=', 5],
            ['category', '=', 'Inglés'],
            ['category', '<', 'M'],
            ['category', '<=', 'Z'],
        ];

        $this->assertEqualsCanonicalizing($expected, $result);
    }
    
    /** @test */
    public function transform_ignores_unknown_params_and_operators(): void{
        $request = new Request([
            'unknown'  => ['eq' => 'x'],        // param no permitido
            'category' => ['gt' => 'A'],        // operador no permitido (gt no está en safe list)
            'id'       => ['eq' => 1],          // válido
        ]);

        $result   = $this->filter->transform($request);

        $expected = [
            ['id', '=', 1],
        ];

        $this->assertEquals($expected, $result);
    }
}
