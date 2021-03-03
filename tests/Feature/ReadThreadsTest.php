<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ReadThreadsTest extends TestCase
{

    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        # Creating thread and asigned to the object
        $this->thread = factory('App\Thread')->create();
    }


    /** @test */
    public function a_user_can_view_all_threads()
    {

        $this->get('/threads')
            ->assertSee($this->thread->title);

    }

    /** @test */
    function a_user_can_view_a_single_thread()
    {
        $this->get('/threads/' . $this->thread->id)
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_read_replies_that_are_associated_with_a_thread()
    {
        // given we have a thread...
        // and that thread include replies

        $reply = factory('App\Reply')
            ->create([ 'thread_id' => $this->thread->id ]);

        // when we visit a thread page
        // then we should see the replies(only body)
        $this->get('/threads/' . $this->thread->id)
            ->assertSee($reply->body);

    }
}
