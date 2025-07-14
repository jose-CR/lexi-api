<?php

namespace Tests\Feature\Controller;

use App\Models\SubCategory;
use App\Models\Word;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WordControllerTest extends TestCase
{
    use RefreshDatabase;

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
        $subCategory = SubCategory::factory()->create();

        $payload = [
            'subCategoryId' => $subCategory->id,
            'letter' => 'A',
            'word' => 'Árbol',
            'definition' => ['planta grande.', 'verde', 'gigante'],
            'sentence' => 'El árbol es muy alto.',
            'spanishSentence' => 'El árbol es muy alto.',
        ];

        $response = $this->postJson('/api/v1/words', $payload);

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

    public function test_it_can_bulk_insert_words(){
        $subCategory = SubCategory::factory()->create();

        $payload = [
            [
                'subCategoryId' => $subCategory->id,
                'letter' => 'B',
                'word' => 'Bicicleta',
                'definition' => ['Vehículo.', 'ruedas'],
                'sentence' => 'Uso la bicicleta todos los días.',
                'spanishSentence' => 'Uso la bicicleta todos los días.',
            ],
            [
                'subCategoryId' => $subCategory->id,
                'letter' => 'C',
                'word' => 'Casa',
                'definition' => ['Lugar.', 'vivienda'],
                'sentence' => 'La casa es blanca.',
                'spanishSentence' => 'La casa es blanca.',
            ],
        ];

        $response = $this->postJson('/api/v1/words/bulk', $payload);

        $response->assertOk()
            ->assertJsonFragment([
                'status' => 'success',
                'inserted' => 2,
            ]);

        $this->assertDatabaseHas('words', ['word' => 'Bicicleta']);
        $this->assertDatabaseHas('words', ['word' => 'Casa']);
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
        $word = Word::factory()->create();
        $newSubCategory = SubCategory::factory()->create();

        $updateData = [
            'subCategoryId' => $newSubCategory->id,
            'letter' => 'Z',
            'word' => 'Zapato',
            'definition' => ['Calzado.', 'pies'],
            'sentence' => 'El zapato es rojo.',
            'spanishSentence' => 'El zapato es rojo.',
        ];

        $response = $this->putJson("/api/v1/words/{$word->id}", $updateData);

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
        $word = Word::factory()->create();

        $response = $this->deleteJson("/api/v1/words/{$word->id}");

        $response->assertOk()
            ->assertJsonFragment([
                'message' => '✅ La palabra se ha eliminado exitosamente',
            ]);

        $this->assertDatabaseMissing('words', [
            'id' => $word->id,
        ]);
    }
}
