<?php

namespace Tests\Unit\Filter;

use Illuminate\Http\Request;
use App\Filters\WordFilter;
use PHPUnit\Framework\TestCase;

class FilterWordTest extends TestCase
{
    protected WordFilter $filter;

    protected function setUp(): void
    {
        parent::setUp();
        $this->filter = new WordFilter();
    }

    /** @test */
    public function transform_builds_expected_conditions(): void{
        $request = new Request([
            'id' => ['eq' => 42],
            'subCategoryId' => [
                'eq' => 7,
            ],
            'letter' => [
                'gte' => 'a',
                'lt'  => 'm',
            ],
            'word' => [
                'eq' => 'zapato',
            ],
            'definition' => [
                'eq' => 'calzado',
            ],
        ]);

        $result   = $this->filter->transform($request);

        $expected = [
            ['id', '=', 42],
            ['sub_category_id', '=', 7],
            ['letter', '>=', 'a'],
            ['letter', '<',  'm'],
            ['word', '=', 'zapato'],
            ['definition', '=', 'calzado'],
        ];

        // Orden indiferente
        $this->assertEqualsCanonicalizing($expected, $result);
    }

    /** @test */
    public function transform_ignores_unknown_params(): void{
        $request = new Request([
            'foo' => ['eq' => 'bar'],      // param no permitido
            'id'  => ['eq' => 1],
        ]);

        $result = $this->filter->transform($request);

        $expected = [['id', '=', 1]];

        $this->assertEqualsCanonicalizing($expected, $result);
    }

    /** @test */
    public function transform_ignores_invalid_operators(): void{
        $request = new Request([
            'letter' => [
                'between' => ['a', 'z'],   // operador no soportado
                'gt'      => 'k',          // operador sí soportado
            ],
        ]);

        $result   = $this->filter->transform($request);
        $expected = [['letter', '>', 'k']];

        $this->assertEqualsCanonicalizing($expected, $result);
    }
}
