<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class request_viewings extends Model
{
    protected $table = 'request_viewings';

    public function user()
    {
        return $this->hasOne('App\User','id','agent_id');
    }

}
