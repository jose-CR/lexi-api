<?php

namespace Tests\Feature\Controller;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Helpers\AuthUserHelper;
use Tests\TestCase;
use Tests\Traits\MakesAuthenticatedRequests;

class SubCategoryControllerTest extends TestCase
{
    use RefreshDatabase;
    use MakesAuthenticatedRequests;

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

        $token = AuthUserHelper::createUserAndGetToken();

        $category = Category::factory()->create();

        $payload = [
            'subCategory' => 'Animales',
            'categoryId' => $category->id,
        ];

        $response = $this->authJsonRequest('postJson', "/api/v1/subcategories", $token, $payload);
    
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

        $token = AuthUserHelper::createUserAndGetToken();

        $subcategory = SubCategory::factory()->create();
        $category = Category::factory()->create();
    
        $payload = [
            'subCategory' => 'Nueva Subcategoría',
            'categoryId' => $category->id,
        ];

        $response = $this->authJsonRequest('putJson', "/api/v1/subcategories/{$subcategory->id}", $token, $payload);
    
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

        $token = AuthUserHelper::createUserAndGetToken();

        $subcategory = SubCategory::factory()->create();

        $response = $this->authJsonRequest('deleteJson', "/api/v1/subcategories/{$subcategory->id}", $token);

        $response->assertOk()
            ->assertJsonFragment([
                'status' => 'success',
            ]);

        $this->assertDatabaseMissing('sub_categories', [
            'id' => $subcategory->id,
        ]);
    }
}
