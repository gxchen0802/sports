<?php

class Workers extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'workers';


    /**
     * Remove mass assignment protection
     * 
     * @var array
     */
    protected $guarded = [];
}
