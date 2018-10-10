<?php

namespace Bitfumes\Likker\Traits;

use Bitfumes\Likker\Like;
use Bitfumes\Likker\LikeCount;

trait CanBeLiked
{
    /**
     * Get all of the Likeable Model's likes.
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    /**
     * Get all of the like counts for Likeable Model.
     */
    public function likeCounts()
    {
        return $this->morphMany(LikeCount::class, 'likeable');
    }

    /**
     * Like like by authenticated user
     * If any user is given like by that user
     * After liking, increments the like Count
     * @param null $user
     */
    public function likeIt($user = null)
    {
        if (!$this->isLiked()) {
            $this->likes()->create([
                'user_id'=> $user ? $user->id : auth()->id()
            ]);
            $this->incrementCount();
        }
    }

    /**
     * It can unlike a liked Model
     * If user is given unlike likeable model for that user
     * After unlike, decrements the like count
     * @param null $user
     */
    public function unLikeIt($user = null)
    {
        if ($like = $this->isLiked($user)) {
            $like->delete();
            $this->decrementCount();
        }
    }

    /**
     * Check if likeable model is liked or not
     * @param null $user
     * @return mixed
     */
    public function isLiked($user = null)
    {
        return $this->likes()->where([
            'user_id'       => $user ? $user->id : auth()->id(),
            'likeable_type' => get_class($this),
            'likeable_id'   => $this->id
        ])->first();
    }

    /**
     * Toggle like of likeable model
     * @param null $user
     */
    public function toggleLike($user = null)
    {
        $this->isLiked($user) ? $this->unLikeIt($user) : $this->likeIt($user);
    }

    /**
     * returns likes of likeable model
     * @return int
     */
    public function countLikes()
    {
        return $this->countExists() ? $this->countExists()->count : 0;
    }

    /**
     * Check if count entry exists in database
     * @return mixed
     */
    public function countExists()
    {
        return $this->likeCounts()
                    ->where([
                        'likeable_id'  => $this->id,
                        'likeable_type'=> get_class($this)
                    ])->first();
    }

    /**
     * If already liked, increment like count
     * Otherwise, create new count entry
     * @return mixed
     */
    public function incrementCount()
    {
        if (!$this->countExists()) {
            return $this->likeCounts()->create();
        }

        $this->countExists()->increment('count');
    }

    /**
     * It decrement like Count
     */
    public function decrementCount()
    {
        $this->countExists()->decrement('count');
    }
}
