<?php

namespace Bitfumes\Likker\Tests\Unit;

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
        $this->post->likeIt();
        $this->assertEquals(2, $this->post->countLikes());
    }

    /** @test */
    public function it_can_decrement_like_count()
    {
        $this->createLoggedInUser();
        $this->post->likeIt();
        $this->assertEquals(1, $this->post->countLikes());
        $this->post->unLikeIt();
        $this->assertEquals(0, $this->post->countLikes());
    }

    /** @test */
    public function if_there_is_no_likes_then_it_should_return_zero()
    {
        $this->assertEquals(0, $this->post->countLikes());
    }
}
