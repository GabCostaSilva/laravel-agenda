<?php

namespace App\Models;

class Contact extends AbstractModel
{
    protected $fillable = ['name', 'email', 'birth', 'uuid'];
    protected $dates  = ['birth'];
    protected $table = 'contacts';
    protected $hidden = ['id'];

    protected function phones() {
        return $this->hasMany('phones');
    }
}
