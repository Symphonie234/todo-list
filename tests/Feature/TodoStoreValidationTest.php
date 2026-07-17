<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoStoreValidationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_store_validation_if_no_title(): void
    {
        $response = $this->post(route('todos.store'), [
            'description' => 'sample',
            'priority' => 'high',
        ]);

        $this->assertDatabaseCount('todos', 0);
        $response->assertSessionHasErrors('title');
    }
}
