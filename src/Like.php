<?php

namespace Bitfumes\Likker;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['user_id', 'likeable_id', 'likeable_type'];

    /**
     * Get all of the owning likeable models.
     */
    public function likeable()
    {
        return $this->morphTo();
    }
}
