<?php

namespace Bitfumes\Likker\Tests\Models;

use Bitfumes\Likker\Traits\CanBeLiked;
use Bitfumes\Likker\Contracts\Likeable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model implements Likeable
{
    use CanBeLiked;
}
