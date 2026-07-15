<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Todo;
use Tests\TestCase;

class TodoToggleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_toggle_flips_is_done_status(): void
    {
        $todo = Todo::create([
            'title' => 'Test todo',
            'is_done' => false,
        ]);

        $this->patch(route('todos.toggle', $todo));

        $this->assertDatabaseHas('todos', ['id' => $todo->id, 'is_done' => true]);
    }
}
