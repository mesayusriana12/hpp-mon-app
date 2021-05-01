<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterRole extends Model
{
    protected $table = 'm_roles';
    protected $fillable = [
        'name'
    ];
}
