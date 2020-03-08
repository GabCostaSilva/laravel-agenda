<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class Contact extends Model
{
    use HasUuId;
    use SoftDeletes;

    protected $hidden = ['id'];
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'birth',
        'street',
        'number',
        'state',
        'country',
        'city',
        'post_code',
        'uuid'
    ];

    protected $dates  = ['birth'];

    public function phones() {
        return $this->hasMany(Phone::class);
    }
}
