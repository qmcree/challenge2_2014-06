<?php

class Country extends Eloquent
{
    protected $table = 'offer_countries';
    protected $primaryKey = 'offer_id';
    public $timestamps = false;

    /**
     * Defines Offer inverse relation.
     *
     * @return mixed
     */
    public function offer()
    {
        return $this->belongsTo('Offer');
    }
} 