<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class history extends Model
{
     use SoftDeletes;
    //
    protected $fillable = [
    'precense_id',
    'name',
    'nik',
    'position',
    'date',
    'status',
];
}
