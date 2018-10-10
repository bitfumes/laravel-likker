<?php

namespace Bitfumes\Likker\Tests\Unit;

use Bitfumes\Likker\Tests\TestCase;

class LikeTest extends TestCase
{
    protected $post;

    public function setup()
    {
        parent::setUp();
        $this->post = $this->createPost();
    }

    /** @test */
    public function it_can_like_a_post()
    {
        $this->createLoggedInUser();
        $this->post->likeIt();
        $this->assertDatabaseHas('likes', ['likeable_type'=>get_class($this->post)]);
    }

    /** @test */
    public function it_can_unlike_a_post()
    {
        $this->createLoggedInUser();
        $this->post->likeIt();
        $this->assertDatabaseHas('likes', ['likeable_type'=>get_class($this->post)]);
        $this->post->unLikeIt();
        $this->assertDatabaseMissing('likes', ['likeable_type'=>get_class($this->post)]);
    }

    /** @test */
    public function like_can_be_done_by_other_user()
    {
        $user = $this->createUser();
        $this->post->likeIt($user);
        $this->assertDatabaseHas('likes', ['user_id'=>$user->id]);
    }

    /** @test */
    public function like_can_be_toggled()
    {
        $user = $this->createLoggedInUser();
        $this->post->toggleLike();
        $this->assertDatabaseHas('likes', ['user_id'=>$user->id]);
        $this->post->toggleLike();
        $this->assertDatabaseMissing('likes', ['user_id'=>$user->id]);
    }

    /** @test */
    public function like_can_be_toggled_any_user()
    {
        $user = $this->createUser();
        $this->post->toggleLike($user);
        $this->assertDatabaseHas('likes', ['user_id'=>$user->id]);
        $this->post->toggleLike($user);
        $this->assertDatabaseMissing('likes', ['user_id'=>$user->id]);
    }

    /** @test */
    public function it_can_only_like_a_post_once_by_a_user()
    {
        $this->createLoggedInUser();
        $this->post->likeIt();
        $this->post->likeIt();
        $this->assertEquals(1, $this->post->countLikes());
    }

    /** @test */
    public function it_can_only_unlike_once_by_a_user()
    {
        $this->createLoggedInUser();
        $this->post->likeIt();
        $this->post->unLikeIt();
        $this->post->unLikeIt();
        $this->assertEquals(0, $this->post->countLikes());
    }
}
