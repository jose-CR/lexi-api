<?php

namespace Tests\Unit\Filter;

use App\Filters\SubCategoryFilter;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

class FilterSubCategoryTest extends TestCase
{
    /** @var CategoryFilter */
    protected SubCategoryFilter $filter;

    protected function setUp(): void{
        parent::setUp();
        $this->filter = new SubCategoryFilter();
    }

    public function transform_maps_id_categoryId_and_subCategory_correctly(): void{
        $request = new Request([
            'id' => [
                'eq' => 10,
                'lt' => 20,
            ],
            'categoryId' => [
                'lte' => 5,
            ],
            'subCategory' => [
                'eq' => 'Animales',
            ],
        ]);

        $result = $this->filter->transform($request);

        $expected = [
            ['id', '=', 10],
            ['id', '<', 20],
            ['category_id', '<=', 5],
            ['subcategory', '=', 'Animales'],
        ];

        $this->assertEqualsCanonicalizing($expected, $result);
    }

    /** @test */
    public function transform_ignores_unknown_params(): void{
        $request = new Request([
            'invalidParam' => [
                'eq' => 'nope',
            ],
            'id' => [
                'eq' => 1,
            ]
        ]);

        $result = $this->filter->transform($request);

        $expected = [
            ['id', '=', 1],
        ];

        $this->assertEqualsCanonicalizing($expected, $result);
    }

    /** @test */
    public function transform_ignores_unsupported_operators(): void{
        $request = new Request([
            'id' => [
                'unsupported' => 123,
                'eq' => 99,
            ]
        ]);

        $result = $this->filter->transform($request);

        $expected = [
            ['id', '=', 99],
        ];

        $this->assertEqualsCanonicalizing($expected, $result);
    }

}