<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserCreateTweetTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test directly create of tweet.
     *
     * @return void
     */
    public function testUserCreateNewTweet()
    {
        // setup
        $user = factory(User::class)->create();

        // exercise
        $user->tweets()->create(['tweet' => 'My tweet!']);

        // verify
        $this->assertDatabaseHas('tweets', ['tweet' => 'My tweet!']);
    }

    /**
     * Test controller by hit endpoint of tweets.store url.
     */
    public function testUserCreateTweetWithLogin()
    {
        // setup
        $user = factory(User::class)->create();

        // exercise
        $response = $this->actingAs($user)->call('POST', route('tweets.store'), ['tweet' => 'My Lovely Tweet!']);

        // verify
        $response->assertRedirect(route('tweets.index'));
        $this->assertDatabaseHas('tweets', ['tweet' => 'My Lovely Tweet!']);
    }
}
