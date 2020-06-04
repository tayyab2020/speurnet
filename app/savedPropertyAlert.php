<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class savedPropertyAlert extends Model
{
    protected $table = 'saved_property_alerts';

    protected $fillable = ['id','user_email'];


}
