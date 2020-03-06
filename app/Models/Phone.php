<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $table = 'phones';
    protected $fillable = ['area_code', 'number'];

    protected function owner() {
        return $this->belongsTo('person', 'owner', 'id');
    }
}
