<?php

namespace Bitfumes\Likker\Tests\Unit;

use Illuminate\Support\Facades\DB;
use Bitfumes\Likker\Tests\TestCase;

class LikeCountTest extends TestCase
{
    protected $post;

    public function setup()  :void
    {
        parent::setUp();
        $this->post = $this->createPost();
    }

    /** @test */
    public function it_can_increment_like_count()
    {
        $this->createLoggedInUser();
        $this->post->likeIt();
        $this->createLoggedInUser();
        $this->post->fresh()->likeIt();
        // DB::enableQueryLog();
        $this->assertEquals(2, $this->post->fresh()->likeCounts->count);
        // dd(DB::getQueryLog());
    }

    /** @test */
    public function it_can_decrement_like_count()
    {
        $this->createLoggedInUser();
        $this->post->likeIt();
        $this->assertEquals(1, $this->post->fresh()->likeCounts->count);
        $this->post->fresh()->unLikeIt();
        $this->assertEquals(0, $this->post->fresh()->likeCounts->count);
    }

    /** @test */
    public function if_there_is_no_likes_then_it_should_return_zero()
    {
        $this->assertEquals(0, $this->post->likeCounts()->count());
    }
}
