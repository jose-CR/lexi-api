<?php

namespace Tests\Feature\Controller;

use App\Models\SubCategory;
use App\Models\Word;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Helpers\AuthUserHelper;
use Tests\TestCase;
use Tests\Traits\MakesAuthenticatedRequests;

class WordControllerTest extends TestCase
{
    use RefreshDatabase;
    use MakesAuthenticatedRequests;

    public function test_it_returns_paginated_words(){
        Word::factory()->count(10)->create();

        $response = $this->getJson('/api/v1/words');

        $response->assertOk()
            ->assertJsonStructure([
                'info' => ['count', 'pages', 'next', 'prev'],
                'data' => [['id', 'subCategoryId', 'letter', 'word', 'definition', 'sentence', 'spanishSentence']],
                'meta' => ['current_page', 'per_page', 'from', 'to', 'last_page', 'total'],
                'links' => ['first', 'prev', 'next', 'last'],
            ]);
    }

    public function test_it_can_store_a_word(){

        $token = AuthUserHelper::createUserAndGetToken();

        $subCategory = SubCategory::factory()->create();

        $payload = [
            'subCategoryId' => $subCategory->id,
            'letter' => 'A',
            'word' => 'Árbol',
            'definition' => ['planta grande.', 'verde', 'gigante'],
            'sentence' => 'El árbol es muy alto.',
            'spanishSentence' => 'El árbol es muy alto.',
            'times' => [
                'pasado' => [
                    'definition' => ['aut', 'quasi', 'harum'],
                    'sentence' => 'Et quia perspiciatis libero.',
                    'spanishSentence' => 'Sed ea ad repudiandae unde non.'
                ],
                'ing' => [
                    'definition' => ['in', 'maxime', 'doloribus'],
                    'sentence' => 'Voluptatem quo ad et voluptas voluptate.',
                    'spanishSentence' => 'Temporibus rerum ut architecto quisquam assumenda sint.'
                ]
            ],
        ];

        $response = $this->authJsonRequest('postJson', "/api/v1/words", $token, $payload);

        $response->assertCreated()
            ->assertJsonFragment([
                'word' => 'Árbol',
                'letter' => 'A',
                'subCategoryId' => $subCategory->id,
            ]);

        $this->assertDatabaseHas('words', [
            'word' => 'Árbol',
            'sub_category_id' => $subCategory->id,
        ]);
    }

    public function test_it_can_bulk_a_word()
    {
        $token = AuthUserHelper::createUserAndGetToken();
        $word = Word::factory()->create();
    
        $newSubCategory = SubCategory::factory()->create();
    
        $payload = [
            'sub_category_id' => $newSubCategory->id,
            'letter' => 'Z',
            'word' => 'Zapato',
            'definition' => 'Calzado, cómodo',
            'sentence' => 'Me pongo los zapatos.',
            'spanish_sentence' => 'Me pongo los zapatos.',
            'times' => [
                'pasado' => [
                    'definition' => 'aut, quasi, harum',
                    'sentence' => 'Et quia perspiciatis libero.',
                    'spanish_sentence' => 'Sed ea ad repudiandae unde non.'
                ],
                'ing' => [
                    'definition' => 'in, maxime, doloribus',
                    'sentence' => 'Voluptatem quo ad et voluptas voluptate.',
                    'spanish_sentence' => 'Temporibus rerum ut architecto quisquam assumenda sint.'
                ]
            ],
        ];
    
        $response = $this->authJsonRequest('putJson', "/api/v1/words/{$word->id}", $token, $payload);
    
        $response->assertOk()
        ->assertJsonFragment([
            'word' => 'Zapato',
            'letter' => 'Z',
            'subCategoryId' => $newSubCategory->id,
        ]);
    
        $this->assertDatabaseHas('words', ['word' => 'Zapato']);
    }
    

    public function test_it_shows_a_word(){
        $word = Word::factory()->create();

        $response = $this->getJson("/api/v1/words/{$word->id}");

        $response->assertOk()
            ->assertJsonFragment([
                'id' => $word->id,
                'word' => $word->word,
            ]);
    }

    public function test_it_can_update_a_word(){

        $token = AuthUserHelper::createUserAndGetToken();

        $word = Word::factory()->create();
        $newSubCategory = SubCategory::factory()->create();

        $payload = [
            'subCategoryId' => $newSubCategory->id,
            'letter' => 'Z',
            'word' => 'Zapato',
            'definition' => 'Calzado, cómodo',
            'sentence' => 'Me pongo los zapatos.',
            'spanishSentence' => 'Me pongo los zapatos.',
            'times' => [
                'pasado' => [
                    'definition' => 'aut, quasi, harum',
                    'sentence' => 'Et quia perspiciatis libero.',
                    'spanishSentence' => 'Sed ea ad repudiandae unde non.'
                ],
                'ing' => [
                    'definition' => 'in, maxime, doloribus',
                    'sentence' => 'Voluptatem quo ad et voluptas voluptate.',
                    'spanishSentence' => 'Temporibus rerum ut architecto quisquam assumenda sint.'
                ]
            ],
        ];
        

        $response = $this->authJsonRequest('putJson', "/api/v1/words/{$word->id}", $token, $payload);

        $response->assertOk()
            ->assertJsonFragment([
                'word' => 'Zapato',
                'letter' => 'Z',
                'subCategoryId' => $newSubCategory->id,
            ]);

        $this->assertDatabaseHas('words', [
            'word' => 'Zapato',
            'sub_category_id' => $newSubCategory->id,
        ]);
    }

    public function test_it_can_delete_a_word(){

        $token = AuthUserHelper::createUserAndGetToken();

        $word = Word::factory()->create();

        $response = $this->authJsonRequest('deleteJson', "/api/v1/words/{$word->id}", $token);

        $response->assertOk()
            ->assertJsonFragment([
                'message' => '✅ La palabra se ha eliminado exitosamente',
            ]);

        $this->assertDatabaseMissing('words', [
            'id' => $word->id,
        ]);
    }
}
