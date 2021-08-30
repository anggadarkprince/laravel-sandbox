<?php

namespace Tests\Unit;

use App\Repositories\TweetRepository;
use App\Services\TweetService;
use Mockery;
use PHPUnit\Framework\TestCase;

class TweetTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetTweets()
    {
        // Setup
        $mock = Mockery::mock(TweetRepository::class);

        $data = [[
            'id' => 1,
            'tweet' => 'sip',
            'user_id' => 1,
            'created_at' => null,
            'updated_at' => null
        ]];
        $mock->shouldReceive('getLatestTweets')->once()->andReturn($data);

        // Exercise
        $userService = new TweetService($mock);
        $results = $userService->getTweets(1);

        // Verify
        $this->assertEquals('sip', $data[0]['tweet']);
    }
}
