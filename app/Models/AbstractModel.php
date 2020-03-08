<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

abstract class AbstractModel extends Model
{
    use HasUuId;
    use SoftDeletes;

    protected $hidden = ['id'];
}
