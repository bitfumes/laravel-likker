<?php

namespace Bitfumes\Likker;

use Illuminate\Database\Eloquent\Model;

class LikeCount extends Model
{
    protected $fillable = ['likeable_id', 'likeable_type'];

    protected $casts = [
        'count' => 'integer'
    ];

    /**
     * Get all of the owning likeable models.
     */
    public function likeable()
    {
        return $this->morphTo();
    }
}
