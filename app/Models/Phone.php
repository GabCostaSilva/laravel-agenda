<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class Phone extends Model
{
    use HasUuId;
    use SoftDeletes;

    protected $hidden = ['id'];
    protected $table = 'phones';
    protected $fillable = ['area_code', 'number', 'primary', 'contact_id'];

    protected function contact() {
        return $this->belongsTo(Contact::class, 'contact_id', 'id');
    }
}
