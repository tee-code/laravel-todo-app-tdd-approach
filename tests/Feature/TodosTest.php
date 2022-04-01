<?php

namespace Tests\Feature;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
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

    public function test_unauthorized_user_cannot_create_todo()
    {

        //Given a task object
        $todo = Todo::factory()->make()->toArray();
        //When an unauthorized user send post request to the endpoint
        $response = $this->post("/todos/create", $todo);
        //It should redirect back to /login
        $response->assertRedirect("/login")
            ->assertStatus(302);

    }

    public function test_a_todo_requires_a_title()
    {

        $this->actingAs(User::factory()->create());

        $todo = Todo::factory()->make([
            'title'=> null
        ])->toArray();

        $this->post('/todos/create', $todo)->assertSessionHasErrors('title');

    }

    public function test_a_todo_requires_a_description()
    {

        $this->actingAs(User::factory()->create());

        $todo = Todo::factory()->make([
            'description'=> null
        ])->toArray();

        $this->post('/todos/create', $todo)->assertSessionHasErrors('description');

    }

    public function test_authorized_user_can_update_a_todo()
    {
        $this->actingAs(User::factory()->create());

        $todo = Todo::factory()->create(['user_id' => Auth::id()]);

        $todo->title = "Updated Todo Title";

        $this->put("/todos/$todo->id", $todo->toArray());

        $this->assertDatabaseHas('todos', ['id' => $todo->id, 'title' => 'Updated Todo Title']);

    }

    public function test_unauthorized_user_can_not_update_a_todo()
    {

        $this->actingAs(User::factory()->create());

        $todo = Todo::factory()->create();

        $todo->title = "Unauthroized Action";

        $this->put("/todos/$todo->id", $todo->toArray())
            ->assertStatus(403);

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
