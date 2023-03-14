<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class todolist extends TestCase
{
    public function test_store_todo_list()
    {
        $this->withoutExceptionHandling();
        $response = $this->getJson(route('todo.store'));
        $this->assertEquals(1, count($response->json));
    }
}
