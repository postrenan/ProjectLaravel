<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $this->markTestIncomplete();
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_should_create_an_article(): void
    {
        $response = $this->post(route('article.store'), [
            'title' => fake()->text(20),
            'content' => fake()->text(20),
            'author' => fake()->name,
            'category' => fake()->name,
        ]);

        dd($response);
        $response->assertStatus(200);
    }
}
