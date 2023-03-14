<?php

namespace Tests\Unit;

use App\Models\Todo;
use App\Models\Todolist;
use Tests\TestCase;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    //user registration

    public function test_register_form_view_successful()
    {
        $response = $this->get('/register');
        $response->assertSuccessful();
        $response->assertViewIs('registers.register');
    }

    public function test_register_new_user_successful()
    {
        $user = [
            'name' => 'sunil',
            'username' => 'sunil',
            'email' => 'sunil@gmail.com',
            'password' => '12345678',
        ];
        $response = $this->post('/singup',$user);
        $this->assertDatabaseHas('users', [
            'username' => 'sunil'
        ]);
        $response->assertRedirect('/');  
    }

    public function test_register_with_minimum_password()
    {
        $user = [
            'name' => 'Rasika',
            'username' => 'Rasika',
            'email' => 'rasika@gmail.com',
            'password' =>  'abc',
        ];
        $response = $this->from('/registers.register')->post('/singup',$user);
        $response->assertRedirect('/registers.register');
        $this->assertDatabaseMissing('users',$user);
        $response->assertStatus(302);
    }

    public function test_register_with_maximum_password()
    {
        $user = [
            'name' => 'Rasika',
            'username' => 'Rasika',
            'email' => 'rasika@gmail.com',
            'password' =>  '1234567891234567',
        ];
        $response = $this->from('/registers.register')->post('/singup',$user);
        $response->assertRedirect('/registers.register');
        $this->assertDatabaseMissing('users',$user);
        $response->assertStatus(302);
    }

    public function test_register_with_incorrect_email()
    {
        $user = [
            'name' => 'Rasika',
            'username' => 'Rasika',
            'email' => 'rasika',
            'password' =>  '123456789',
        ];
        $response = $this->from('/registers.register')->post('/singup',$user);
        $response->assertRedirect('/registers.register');
        $this->assertDatabaseMissing('users',$user);
        $response->assertStatus(302);
    }

    public function test_user_cant_duplicate_register()
    {
        $user1 = User::create([
            'name' => 'Nimal',
            'username' => 'Rasika',
            'email' => 'rasika@gmail.com',
            'password' => '12345678',
        ]);
        $user2 = [
            'name' => 'Nimal',
            'username' => 'Rasika',
            'email' => 'asika@gmail.com',
            'password' => '12345678',
        ];
        $this->post('/singup', $user1->toArray())
            ->assertRedirect('/');

        $response = $this->post('/singup', $user2);
        $this->assertDatabaseMissing('users', $user2);
        $response->assertStatus(302);
    }

    // user login


    public function test_login_form_view_successful()
    {
        $response = $this->get('/login');
        $response->assertSuccessful();
        $response->assertViewIs('session.login');
    }

    public function test_user_login_successfully()
    {
        $user = User::factory()->create();
        $response = $this->post('/session',$user->toArray());
        $response->assertRedirect('/');
        
    }

    public function test_user_login_with_correct_credentials()
    {

        User::factory()->create([
            'username' => 'nimal',
            'password' => bcrypt('password')
        ]);

        $response = $this->post('/session', [
            'username' => 'nimal',
            'password' => 'password'
        ]);
        $response = $this->get('/login');
        $response->assertRedirect('/');
        $this->assertAuthenticated();
    }

    public function test_users_can_not_authenticate_with_invalid_password()
    {
        $user = User::factory()->create([
            'password' => bcrypt('123-abc')
        ]);

        $response = $this->from('/session')->post('/session', [
            'username' => $user->username,
            'password' => 'wrong-password',
        ]);
        $this->assertGuest();
        $response->assertRedirect('/session');
        $response->assertStatus(302);
    }

    //todo list , sub todo 

    public function test_authenticated_user_can_read_todo_list(){
        $user = User::factory()->create([
            'username' => 'nimal',
            'password' => bcrypt('password')
        ]);
        $this->actingAs($user);
        $todolist = Todo::factory()->create([
            'title' => 'new todo list',
            'user_id' => $user->id,
        ]);
        $response = $this->get('/');
        $response->assertSee($todolist->title);
    }

    public function test_todo_list_add_form_view_successful()
    {
        $response = $this->get('/add');
        $response->assertSuccessful();
        $response->assertViewIs('todos.index');
    }

    public function test_sub_todo_add_form_view_successful()
    {
        $response = $this->get('/create/{id}');
        $response->assertSuccessful();
        $response->assertViewIs('create');
    }

    public function test_todo_list_create_successful()
    {
        $user = User::factory()->create([
            'username' => 'nimal',
            'password' => bcrypt('password')
        ]);
        $this->actingAs($user);
//check
        $todolist = Todo::factory()->count(1)->create();

        $this->post('/todo', $todolist->toArray());

        $this->assertEquals(1, $todolist->count());
    }

    public function test_sub_todo_create_successful()
    {
        $user = User::factory()->create([
            'username' => 'nimal',
            'password' => bcrypt('password')
        ]);
        $this->actingAs($user);

        $todo = Todolist::factory()->count(1)->make();

        $this->post('/create/store', $todo->toArray());

        $this->assertEquals(1, $todo->count());
    }

    public function test_sub_todo_list_delete_successful()
    {
        $this->actingAs(User::factory()->create());
        $todo = Todo::factory()->create(['user_id' => auth()->user()->id]);
        $todolist = Todolist::factory()->create(['todo_id' => $todo->id]);
        $this->delete('/delete/' . $todolist->id);
        $this->assertDatabaseMissing('todolists', [
            'id' => $todolist->id
        ]);
    }

    public function test_todo_list_delete_successful()
    {
        $this->actingAs(User::factory()->create());
        $todo = Todo::factory()->create(['user_id' => auth()->user()->id]);
        $this->delete('/remove/' . $todo->id);
        $this->assertDatabaseMissing('todos', [
            'id' => $todo->id
        ]);
    }

    //database

    public function test_database_has_data()
    {
        User::create([
            'name' => 'Nimal',
            'username' => 'Rasika',
            'email' => 'rasika@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $this->assertDatabaseHas('users', [
            'username' => 'Rasika'
        ]);
    }
   

}
