<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTweetTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test page of create tweet page.
     *
     * @return void
     */
    public function testShowCreateTweetPage()
    {
        // exercise
        $response = $this->get(route('tweets.create'));

        // verify
        //$this->assertEquals(200, $response->status());
        $response->assertStatus(200);
    }

    /**
     * No controller test, we don't know if user is logged in or not
     */
    public function testUserCreateTweet()
    {
        // setup
        $user = factory(User::class)->create();

        // exercise
        $user->tweets()->create(['tweet' => 'My tweet!']);

        // verify
        $this->assertDatabaseHas('tweets', ['tweet' => 'My tweet!']);
    }

    /**
     * Test tweet creation by login user.
     */
    public function testUserCreateTweetWithLogin()
    {
        // setup
        $user = factory(User::class)->create();

        // exercise
        $response = $this->actingAs($user)->post(route('tweets.store'), ['tweet' => 'My Lovely Tweet!']);

        // verify
        $response->assertStatus(302);
        $response->assertRedirect(route('tweets.index'));
        $this->assertDatabaseHas('tweets', ['tweet' => 'My Lovely Tweet!']);
    }

    /**
     * Check if tweet should not allowed to tweets more than 5 items.
     */
    public function testMaxTweetCreatedPerUser()
    {
        // setup
        $user = factory(User::class)->create();

        foreach (range(1, 5) as $i) {
            $user->tweets()->create(['tweet' => 'My tweet ' . $i]);
        }

        // exercise
        $response = $this->actingAs($user)->post(route('tweets.store'), ['tweet' => 'My failed tweet']);

        // verify
        $response->assertStatus(302);
        $response->assertRedirect(route('tweets.create'));
        $this->assertContains(session('status'), ['error', 'danger']);
        $this->assertDatabaseMissing('tweets', ['tweet' => 'My failed tweet']);
    }

    /**
     * Test directly user following someone.
     */
    public function testUserFollowSomeone()
    {
        // setup
        $userOne = factory(User::class)->create();
        $userTwo = factory(User::class)->create();

        // exercise
        $userOne->followings()->attach($userTwo);

        // verify
        $this->assertDatabaseHas('user_follows', [
            'user_id' => $userOne->id,
            'follow_id' => $userTwo->id
        ]);

        $this->assertGreaterThan(0, $userOne->followings->count());

        $this->assertGreaterThan(0, $userTwo->followers->count());
    }
}
