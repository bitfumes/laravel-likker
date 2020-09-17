<?php

namespace Bitfumes\Likker\Contracts;

interface Likeable
{
    public function likeIt();

    public function unLikeIt();

    public function toggleLike();

    public function isLiked();

    public function countLikes();

    public function incrementCount();

    public function decrementCount();
}
