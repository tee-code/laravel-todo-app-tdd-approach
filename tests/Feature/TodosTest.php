<?php

namespace Tests\Feature;

use App\Models\Todo;
use App\Models\User;
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

    public function test_authenticated_user_can_create_a_todo(){

        //Given that we have an authenticated user
        $this->actingAs(User::factory()->create());
        //and a todo object
        $todo = Todo::factory()->make()->toArray();
        //when a post request is sent to the endpoint
        $response = $this->post("/todos/create", $todo);
        //it gets saved into the database
        $this->assertEquals(1, Todo::all()->count());
        //redirect to show the todo
        $response->assertRedirect();
        // and a success response is returned
        $response->assertStatus(302);
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
