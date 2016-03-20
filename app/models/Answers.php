<?php

class Answers extends Eloquent {

    protected $table = 'questionaires_answers';

    protected $guarded = [];

    public function scopeNotDeleted($query)
    {
        return $query->where('status', '!=', 'deleted');
    }
}
