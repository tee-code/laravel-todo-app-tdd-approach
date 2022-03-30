<?php

namespace Tests\Feature;

use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodosTest extends TestCase
{
    use WithFaker, RefreshDatabase;


    public function test_a_user_can_create_a_todo()
    {

        $this->withoutExceptionHandling();

        $todo = Todo::factory()->make()->toArray();

        $this->post("/todos", $todo)
            ->assertRedirect('/')
            ->assertStatus(302);

        $this->assertDatabaseHas('todos', $todo);

    }

    public function test_a_user_can_get_todos(){

        $todo = Todo::factory()->create();

        $response = $this->get('/todos');

        $response->assertSee($todo->title);

    }

    public function test_a_user_can_read_a_todo()
    {

        $todo = Todo::factory()->create();

        $response = $this->get("/todos/$todo->id");

        $response->assertSee($todo->title)
            ->assertSee($todo->description);

    }


    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
