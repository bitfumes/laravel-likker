<?php

namespace Bitfumes\Likker\Traits;

trait CanLike
{
    /**
     * Get all of the post's like.
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
}
