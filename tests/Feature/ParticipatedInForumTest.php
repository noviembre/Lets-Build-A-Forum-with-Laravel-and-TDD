<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ParticipatedInForumTest extends TestCase
{

    use DatabaseTransactions;

    /** @test */
    function an_authenticated_users_may_not_add_replies()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->post('/threads/1/replies', []);

    }
    /**  @test */
    function an_authenticated_user_may_participate_in_forum_threads()
    {

        // Given we have an authenticated user
        $this->be($user = factory('App\User')->create());

        // and an existing thread
        $thread = factory('App\Thread')->create();

        // when the user adds a reply to the thread
        $reply = factory('App\Reply')->make();
        // and submit to the server
        $this->post($thread->path() . '/replies', $reply->toArray());

        // then their reply should be visible
        $this->get($thread->path())->assertSee($reply->body);


    }

}
