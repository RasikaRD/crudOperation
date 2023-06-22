<?php

namespace Tests\Feature;

use App\Models\Todo;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class todolist extends TestCase
{
    use RefreshDatabase;
    public function test_view_todo_list()
    {
        $user = User::factory()->create();
        // $user = Auth::user();
        $token = $user->createToken('MyApp')->accessToken;
        dd($token);
        $headers = [
            'Authorization' =>$token,
        ];

        $response = $this->getJson(route('list.todo'), $headers);
        $response->assertStatus(200, $response->status());
        $this->assertEquals(1, count($response->json(['data'])));
    }
}
