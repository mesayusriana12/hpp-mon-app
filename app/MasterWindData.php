<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterWindData extends Model
{
    protected $table = 'm_wind_data';
    protected $fillable = [
        'data_id','voltage','current','rpm','wind_speed','main_data_id'
    ];
}
