<?php

class Questions extends Eloquent {

    protected $table = 'questionaires_questions';

    protected $guarded = [];

    public function scopeNotDeleted($query)
    {
        return $query->where('status', '!=', 'deleted');
    }
}
