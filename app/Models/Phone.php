<?php

namespace App\Models;

class Phone extends AbstractModel
{
    protected $table = 'phones';
    protected $fillable = ['area_code', 'number'];

    protected function owner() {
        return $this->belongsTo('contacts', 'owner', 'id');
    }
}
