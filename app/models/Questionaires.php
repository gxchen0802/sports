<?php

class Questionaires extends Eloquent {

    protected $table = 'questionaires';

    protected $guarded = [];

    public function scopeNotDeleted($query)
    {
        return $query->where('status', '!=', 'deleted');
    }

    public function scopeIsActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeNotExpire($query)
    {
        return $query->where('end_time', '>=', date('Y-m-d H:i:s'));
    }
}
