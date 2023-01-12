<?php

namespace Tests\Feature;

use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function guests_may_not_create_threads()
    {
        $this->withExceptionHandling();

        $thread = make('App\Thread');

        $this->post('/threads', $thread->toArray());
    }

    /** @test */
    function guests_cannot_see_the_create_thread_page()
    {
        $this->withExceptionHandling()
            ->get('/threads/create')
            ->assertRedirect('login');
    }

    //    /** @test */
    //    function an_authenticated_user_can_create_new_forum_threads()
    //    {
    //        $this->signIn();
    //
    //        $thread = make(Thread::class);
    //
    //        $this->post('/threads', $thread->toArray());
    //
    //        $this->get($thread->path())
    //            ->assertSee($thread->title)
    //            ->assertSee($thread->body);
    //
    //    }
}
