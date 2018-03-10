<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_browse_threads()
    {
        $thread = factory('App\Thread')->create();
        $response = $this->get('/threads');

        // assert that we see the page
        $response->assertStatus(200);
        // assert that we see a the treads
        $response->assertSee($thread->title);

        $response = $this->get('/threads/' . $thread->id);
        $response->assertSee($thread->title);
    }
}
