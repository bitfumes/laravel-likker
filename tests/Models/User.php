<?php

namespace Bitfumes\Likker\Tests\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Bitfumes\Likker\Contracts\Liker;
use Bitfumes\Likker\Traits\CanLike;

class User extends Authenticatable implements Liker
{
    use CanLike;
}
