<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterReport extends Model
{
    protected $table = 'm_report';
    protected $fillable = [
        'type', 'file_report', 'user_id'
    ];
}
