<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FollowTest extends TestCase
{
    use DatabaseMigrations;

    /**
    * user a can follow user b
    *
    * @test
    */
    function user_a_can_follow_user_b()
    {
        $userA = factory(User::class)->create();
        $userB = factory(User::class)->create();

        // Login as UserA
        $this->actingAs($userA);

        // Check before hand for followers
        $this->assertEquals(0, $userA->following()->count());
        $this->assertEquals(0, $userB->followers()->count());

        // Follow userB
        $userA->following()->attach($userB->id);

        // Assert
        $this->assertEquals(1, $userA->following()->count());
        $this->assertEquals(1, $userB->followers()->count());

        // Asset helper function on model
        $this->assertTrue($userA->isFollowing($userB->id));

        // test is_followed attribute / accessor
        $this->assertTrue($userB->is_followed);
        $this->assertFalse($userA->is_followed);
    }
}
