<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterSunData extends Model
{
    protected $table = 'm_sun_data';
    protected $fillable = [
        'data_id','voltage','lux','main_data_id'
    ];
}
