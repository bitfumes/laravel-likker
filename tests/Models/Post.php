<?php

namespace Bitfumes\Likker\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Bitfumes\Likker\Contracts\Likeable;
use Bitfumes\Likker\Traits\CanBeLiked;

class Post extends Model implements Likeable
{
    use CanBeLiked;
}
