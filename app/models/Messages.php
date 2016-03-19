<?php

class Messages extends Eloquent {

    protected $table = 'messages';

    protected $guarded = [];

    public function scopeNotDeleted($query)
    {
        return $query->where('status', '!=', 'deleted');
    }

    public function scopeUnreply($query)
    {
        return $query->where('reply', '')->orWhere('reply', NULL);
    }
}
