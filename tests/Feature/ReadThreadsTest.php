<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @property mixed thread
 */
class ReadThreadsTest extends TestCase
{
//    use DatabaseMigrations;

    function setUp()
    {
        parent::setUp();

        // create a thread and assign it to the object
        $this->thread = factory('App\Thread')->create();
    }

    /** @test */
    function a_user_can_view_all_threads()
    {
        $response = $this->get('/threads');

        $response->assertSee($this->thread->title);
    }

    /** @test */
    function a_user_can_read_a_single_thread()
    {
        $response = $this->get('/threads/' . $this->thread->id);
        $response->assertSee($this->thread->title);
    }

    /** @test */
    function a_user_can_read_replies_that_are_associated_with_a_thread()
    {
        /*
            - Given we have a thread
            - and that thread includes replies
            - when we visit a thread page
            - then we should see the reply
        */
        $reply = factory('App\Reply')
            ->create(['thread_id' => $this->thread->id]);

        $this->get('/threads/' . $this->thread->id)
            ->assertSee($reply->body)
            ->assertSee($reply->owners->name)
            ->assertSee($reply->created_at);
    }
}
