<?php

class Offer extends Eloquent
{
    public $timestamps = false;

    /**
     * Defines Leadstat relation.
     *
     * @return mixed
     */
    public function leadstat()
    {
        return $this->hasOne('Leadstat');
    }

    /**
     * Defines Country relation.
     *
     * @return mixed
     */
    public function countries()
    {
        return $this->hasMany('Country');
    }
} 