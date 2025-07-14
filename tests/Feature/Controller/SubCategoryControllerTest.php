<?php

namespace Tests\Feature\Controller;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubCategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_paginated_subcategories(){
        SubCategory::factory()->count(10)->create();

        $response = $this->getJson('/api/v1/subcategories');

        $response->assertOk()
            ->assertJsonStructure([
                'info' => ['count', 'pages', 'next', 'prev'],
                'data' => [['id', 'subCategory', 'categoryId']],
                'meta' => ['current_page', 'per_page', 'from', 'to', 'last_page', 'total'],
                'links' => ['first', 'prev', 'next', 'last']
            ]);
    }

    public function test_it_can_store_a_subcategory(){
        $category = Category::factory()->create();

        $payload = [
            'subCategory' => 'Animales',
            'categoryId' => $category->id,
        ];
    
        $response = $this->postJson('/api/v1/subcategories', $payload);
    
        $response->assertCreated()
            ->assertJsonFragment([
                'subCategory' => 'Animales',
                'categoryId' => $category->id,
            ]);
    
        $this->assertDatabaseHas('sub_categories', [
            'subcategory' => 'Animales',
            'category_id' => $category->id,
        ]);
    }

    public function test_it_can_show_a_subcategory(){
        $subcategory = SubCategory::factory()->create();

        $response = $this->getJson("/api/v1/subcategories/{$subcategory->id}");

        $response->assertOk()
            ->assertJsonFragment([
                'id' => $subcategory->id,
                'subCategory' => $subcategory->subcategory,
            ]);
    }

    public function test_it_can_update_a_subcategory(){
        $subcategory = SubCategory::factory()->create();
        $category = Category::factory()->create();
    
        $updateData = [
            'subCategory' => 'Nueva Subcategoría',
            'categoryId' => $category->id,
        ];
    
        $response = $this->putJson("/api/v1/subcategories/{$subcategory->id}", $updateData);
    
        $response->assertOk()
            ->assertJsonFragment([
                'subCategory' => 'Nueva Subcategoría',
                'categoryId' => $category->id,
            ]);
    
        $this->assertDatabaseHas('sub_categories', [
            'subcategory' => 'Nueva Subcategoría',
            'category_id' => $category->id,
        ]);
    }

    public function test_it_can_delete_a_subcategory(){
        $subcategory = SubCategory::factory()->create();

        $response = $this->deleteJson("/api/v1/subcategories/{$subcategory->id}");

        $response->assertOk()
            ->assertJsonFragment([
                'status' => 'success',
            ]);

        $this->assertDatabaseMissing('sub_categories', [
            'id' => $subcategory->id,
        ]);
    }
}
