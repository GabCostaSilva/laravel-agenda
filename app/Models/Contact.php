<?php

namespace App\Models;

class Contact extends AbstractModel
{
    protected $fillable = ['first_name', 'last_name', 'email', 'birth', 'uuid'];
    protected $dates  = ['birth'];
    protected $table = 'contacts';
    protected $hidden = ['id'];

    protected function phones() {
        return $this->hasMany('phones');
    }
}
