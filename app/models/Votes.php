<?php

class Votes extends Eloquent {

    protected $table = 'questionaires_votes';

    protected $guarded = [];

    public function scopeNotDeleted($query)
    {
        return $query->where('status', '!=', 'deleted');
    }
}
