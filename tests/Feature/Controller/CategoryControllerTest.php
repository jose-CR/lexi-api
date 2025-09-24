<?php

namespace Tests\Feature\Controller;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Helpers\AuthUserHelper;
use Tests\Traits\MakesAuthenticatedRequests;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;
    use MakesAuthenticatedRequests;

    /** @test */
    public function it_returns_a_paginated_list_of_categories(){
        Category::factory()->count(15)->create();

        $response = $this->getJson('/api/v1/categories');

        $response->assertOk()
            ->assertJsonStructure([
                'info' => ['count', 'pages', 'next', 'prev'],
                'data' => [['id', 'category']], // Ajusta según CategoryResource
                'meta' => ['current_page', 'per_page', 'from', 'to', 'last_page', 'total'],
                'links' => ['first', 'prev', 'next', 'last']
            ]);
    }

    /** @test */
    public function it_can_create_a_category(){

        $token = AuthUserHelper::createUserAndGetToken();

        $payload = ['category' => 'Naturaleza'];

        $response = $this->authJsonRequest('postJson', '/api/v1/categories', $token, $payload);

        $response->assertCreated()
        ->assertJsonFragment([
            'message' => '✅ Se ha creado una nueva categoría correctamente.',
            'category' => 'Naturaleza',
        ]);

        $this->assertDatabaseHas('categories', ['category' => 'Naturaleza']);
    }

    /** @test */
    public function it_can_show_a_single_category(){
        $category = Category::factory()->create();

        $response = $this->getJson("/api/v1/categories/{$category->id}");

        $response->assertOk()
            ->assertJsonFragment([
                'id' => $category->id,
                'category' => $category->category
            ]);
    }

    /** @test */
    public function it_can_update_a_category(){

        $token = AuthUserHelper::createUserAndGetToken();

        $category = Category::factory()->create([
            'category' => 'Original'
        ]);

        $payload = ['category' => 'Modificado'];

        $response = $this->authJsonRequest('putJson', "/api/v1/categories/{$category->id}", $token, $payload);

        $response->assertOk()
            ->assertJsonFragment([
                'message' => '✅ Categoría actualizada correctamente.',
                'category' => 'Modificado'
            ]);

        $this->assertDatabaseHas('categories', ['category' => 'Modificado']);
    }

    /** @test */
    public function it_can_delete_a_category(){

        $token = AuthUserHelper::createUserAndGetToken();

        $category = Category::factory()->create();

        $response = $this->authJsonRequest('deleteJson', "/api/v1/categories/{$category->id}", $token);

        $response->assertOk()
            ->assertJsonFragment([
                'message' => "✅ La Categoria se ha eliminado exitosamente",
            ]);

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
